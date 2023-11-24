<?php
namespace App\Helpers;

use App\Events\Clients\Users\AllUsersEvent;
use App\Events\FileUploadProgressEvent;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Google_Service_YouTube;
use Livewire\Livewire;

class GoogleDriveHelper
{
    public static function getClient()
    {
        $client = new Google_Client([
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
            'scopes' => [
                Google_Service_Drive::DRIVE_FILE,
                Google_Service_YouTube::YOUTUBE_UPLOAD,
            ],
        ]);

        $client->setAccessType("offline");

        if (file_exists('clients/assets/js/token_log_gg.json')) {
            $accessToken = json_decode(file_get_contents('clients/assets/js/token_log_gg.json'), true);
            // Kiểm tra xem access token có hết hạn chưa
            if ($client->isAccessTokenExpired()) {
                // Làm mới access token bằng refresh token
                $refreshToken = $accessToken['refresh_token'];
                $client->fetchAccessTokenWithRefreshToken($refreshToken);
                $newAccessToken = $client->getAccessToken();
                $newAccessToken['refresh_token'] = $refreshToken;
                file_put_contents('clients/assets/js/token_log_gg.json', json_encode($newAccessToken));
            } else {
                $client->setAccessToken($accessToken);
            }
        } else {
            $authUrl = $client->createAuthUrl();
            return redirect($authUrl);
        }

        return $client;
    }

    public static function uploadFile($file)
    {

        $client = self::getClient();
        $driveService = new Google_Service_Drive($client);

        // Check if 'social' folder exists
        $socialFolderId = self::checkFolderExists($driveService, 'social');
        Event::dispatch(new AllUsersEvent('loading', 'start',auth()->user()->user_id, '', ''));
        // If 'social' folder doesn't exist, create it
        if (!$socialFolderId) {
            $folderMetadata = new Google_Service_Drive_DriveFile([
                'name' => 'social',
                'mimeType' => 'application/vnd.google-apps.folder',
            ]);
            $createdFolder = $driveService->files->create($folderMetadata, [
                'fields' => 'id',
            ]);
            $socialFolderId = $createdFolder->id;
        }

        // Create a folder name based on the date
        $dateFolderName = date('d-m-Y');
        $dateFolderExists = self::checkFolderExists($driveService, $dateFolderName);

        // If the date folder doesn't exist, create it in the 'social' folder
        if (!$dateFolderExists) {
            $folderMetadata = new Google_Service_Drive_DriveFile([
                'name' => $dateFolderName,
                'parents' => [$socialFolderId],
                'mimeType' => 'application/vnd.google-apps.folder',
            ]);
            $createdFolder = $driveService->files->create($folderMetadata, [
                'fields' => 'id',
            ]);
            $folderId = $createdFolder->id;
        } else {
            // If the date folder exists, use its id
            $folderId = $dateFolderExists;
        }

        // Generate a new file name
        $newFileName = bin2hex(random_bytes(16)) . '.' . $file->getClientOriginalExtension();

        // Define allowed extensions
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'mp4', 'txt', 'zip', 'rar', 'docx', 'pdf', 'msi'];
        $fileExtension = $file->getClientOriginalExtension();

        if (in_array($fileExtension, $allowedExtensions)) {
            // Define the chunk size
            $chunkSizeBytes = 10 * 1024 * 1024; // 1MB

            // Call the API with the media upload, defer so it doesn't immediately return.
            $client->setDefer(true);

            // File metadata
            $fileMetadata = new Google_Service_Drive_DriveFile([
                'name' => $newFileName,
                'parents' => [$folderId],
            ]);

            // Create a request
            $request = $driveService->files->create($fileMetadata);

            // Create a media file upload to represent our upload process.
            $media = new \Google_Http_MediaFileUpload(
                $client,
                $request,
                'application/octet-stream',
                null,
                true,
                $chunkSizeBytes
            );

            // Set file size
            $media->setFileSize(filesize($file->getRealPath()));

            // Upload the various chunks.
            // The status will be false until the process is complete.
            $status = false;

            // Open file handle
            $handle = fopen($file->getRealPath(), "rb");
            $totalFileSize = filesize($file->getRealPath());
            $uploadedSize = 0;

            while (!$status && !feof($handle)) {
                // Read a chunk of file
                $chunk = fread($handle, $chunkSizeBytes);

                // Upload the chunk
                $status = $media->nextChunk($chunk);
                $uploadedSize += strlen($chunk);

                // Calculate the progress based on the uploaded size
                $progress = ($uploadedSize / $totalFileSize) * 100;

                // Send an event with the current progress
                event(new FileUploadProgressEvent($progress));
            }

            // Ensure the final progress is sent, even if it doesn't reach 100%
            if ($progress < 100) {
                event(new FileUploadProgressEvent(100));
            }

            // Close file handle
            fclose($handle);

            // Reset to the client to execute requests immediately in the future.
            $client->setDefer(false);
            // Create permissions for the file
            $permissionMetadata = new \Google_Service_Drive_Permission([
                'type' => 'anyone',
                'role' => 'reader',
            ]);

            // Add permissions to the file
            $driveService->permissions->create($status->id, $permissionMetadata);

            // Get file metadata
            $uploadedFile = $driveService->files->get($status->id, ['fields' => 'webViewLink']);
            $downloadLink = "https://drive.google.com/uc?export=download&id=" . $status->id;
            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully!',
                'filename' => $newFileName,
                'filepath' => $downloadLink,
                'fileId' => $status->id
            ]);
        } else {
            return false;
        }
    }

    public static function deleteFile($fileId)
    {
        $client = self::getClient();
        $driveService = new Google_Service_Drive($client);

        try {
            $driveService->files->delete($fileId);
            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully!',
            ]);
        } catch (\Google_Service_Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting file: ' . $e->getMessage(),
            ]);
        }
    }




    public static function checkFolderExists($driveService, $folderName)
    {
        $results = $driveService->files->listFiles([
            'q' => "mimeType='application/vnd.google-apps.folder' and name='$folderName'",
        ]);

        if (count($results->getFiles()) > 0) {
            return $results->getFiles()[0]->getId();
        } else {
            return false;
        }
    }

    // public static function uploadVideoToYouTube($file, $title, $description, $tags)
    // {
    //     $client = self::getClient();

    //     $youtube = new \Google_Service_YouTube($client);


    //     // Thiết lập thông tin video
    //     $videoSnippet = new \Google_Service_YouTube_VideoSnippet();
    //     $videoSnippet->setTitle($title);
    //     $videoSnippet->setDescription($description);
    //     $videoSnippet->setTags($tags);

    //     $video = new \Google_Service_YouTube_Video();
    //     // Đặt thông tin videoSnippet vào video
    //     $video->setSnippet($videoSnippet);

    //     // Đối tượng Google_Service_YouTube_VideoStatus
    //     $videoStatus = new \Google_Service_YouTube_VideoStatus();
    //     $videoStatus->privacyStatus = 'private'; // Chọn quyền riêng tư của video

    //     // Đặt thông tin videoStatus vào video
    //     $video->setStatus($videoStatus);

    //     // Upload video lên YouTube
    //     $chunkSizeBytes = 10 * 1024 * 1024; // Kích thước chunk cho upload (1MB)
    //     $client->setDefer(true);
    //     $request = $youtube->videos->insert('status,snippet', $video);

    //     // Đọc từng phần của tệp video và upload theo từng chunk
    //     $media = new \Google_Http_MediaFileUpload(
    //         $client,
    //         $request,
    //         'video/*',
    //         null,
    //         true,
    //         $chunkSizeBytes
    //     );
    //     $media->setFileSize(filesize($file));
    //     $status = false;
    //     $handle = fopen($file, 'rb');

    //     while (!$status && !feof($handle)) {
    //         $chunk = fread($handle, $chunkSizeBytes);
    //         $status = $media->nextChunk($chunk);
    //     }
    //     fclose($handle);

    //     // Hoàn tất quá trình upload
    //     $client->setDefer(false);

    //     // Trả về đường dẫn đến video đã tải lên
    //     return "https://www.youtube.com/watch?v=" . $status['id'];
    // }
    public static function uploadVideoToYouTube($file, $title, $description, $tags)
    {
        $client = self::getClient();
        $youtube = new \Google_Service_YouTube($client);

        // Thiết lập thông tin video
        $videoSnippet = new \Google_Service_YouTube_VideoSnippet();
        $videoSnippet->setTitle($title);
        $videoSnippet->setDescription($description);
        $videoSnippet->setTags($tags);

        $video = new \Google_Service_YouTube_Video();
        // Đặt thông tin videoSnippet vào video
        $video->setSnippet($videoSnippet);

        // Đối tượng Google_Service_YouTube_VideoStatus
        $videoStatus = new \Google_Service_YouTube_VideoStatus();
        $videoStatus->privacyStatus = 'private'; // Chọn quyền riêng tư của video

        // Đặt thông tin videoStatus vào video
        $video->setStatus($videoStatus);
        $chunkSizeBytes = 10 * 1024 * 1024; // 10MB
        $client->setDefer(true);
        $request = $youtube->videos->insert('status,snippet', $video);
        $media = new \Google_Http_MediaFileUpload(
            $client,
            $request,
            'video/*',
            null,
            true,
            $chunkSizeBytes
        );

        $media->setFileSize(filesize($file->getRealPath()));
        $status = false;
        $handle = fopen($file->getRealPath(), 'rb');
        $totalFileSize = filesize($file->getRealPath());
        $uploadedSize = 0;

        while (!$status && !feof($handle)) {
            $chunk = fread($handle, $chunkSizeBytes);
            $status = $media->nextChunk($chunk);
            $uploadedSize += strlen($chunk);

            // Calculate the progress based on the uploaded size
            $progress = ($uploadedSize / $totalFileSize) * 100;

            // Send an event with the current progress
            event(new FileUploadProgressEvent($progress));
        }

        // Ensure the final progress is sent, even if it doesn't reach 100%
        if ($progress < 100) {
            event(new FileUploadProgressEvent(100));
        }

        fclose($handle);
        $client->setDefer(false);

        return "https://www.youtube.com/watch?v=" . $status['id'];
    }



}
