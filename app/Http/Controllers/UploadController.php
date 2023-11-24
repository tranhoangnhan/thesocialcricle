<?php

namespace App\Http\Controllers;

use App\Helpers\GoogleDriveHelper;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_YouTube;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function youtube()
    {
        return view('uploadYT');
    }

    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $log = GoogleDriveHelper::uploadFile($file);
            return $log;
        } else {
            return 'Không có tệp để tải lên.';
        }
    }

    public function deleteFile(Request $request)
    {
        $fileId = $request->input('fileId');
        if ($fileId) {
            $result = GoogleDriveHelper::deleteFile($fileId);
            return $result;
        } else {
            return 'File ID is missing.';
        }
    }


    public function uploadYoutube(Request $request)
    {
        // Xác thực và tải lên video lên YouTube
        $file = $request->file('video'); // Lấy file video từ request
        $title = $request->input('title'); // Lấy tiêu đề từ request
        $description = $request->input('description'); // Lấy mô tả từ request
        $tags = $request->input('tags'); // Lấy danh sách thẻ từ request

        // Gọi phương thức uploadVideoToYouTube từ GoogleDriveHelper
        $videoUrl = GoogleDriveHelper::uploadVideoToYouTube($file, $title, $description, $tags);

        // Xử lý dựa trên kết quả
        if ($videoUrl) {
            return redirect()->back()->with('success', 'Video đã được tải lên thành công. Đường dẫn video trên YouTube: ' . $videoUrl);
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tải lên video.');
        }
    }

    public function oauthCallback(Request $request)
    {
        $code = $request->get('code');
        if ($code) {
            $client = new Google_Client([
                'client_id' => env('GOOGLE_CLIENT_ID'),
                'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
                'scopes' => [
                    Google_Service_Drive::DRIVE_FILE,
                    Google_Service_YouTube::YOUTUBE_UPLOAD,
                ],
            ]);

            // Lấy lại mã truy cập mới bằng mã xác thực
            $accessToken = $client->fetchAccessTokenWithAuthCode($code);
            $client->setAccessToken($accessToken);

            // Lưu token truy cập và refresh token để sử dụng trong tương lai
            file_put_contents('clients/assets/js/token_log_gg.json', json_encode($accessToken));

            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Lỗi xác thực OAuth.');
        }
    }
    public function reauthenticate()
    {
        // Tạo một đối tượng Google_Client mới
        $client = new Google_Client([
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
            'scopes' => [
                Google_Service_Drive::DRIVE_FILE,
                Google_Service_YouTube::YOUTUBE_UPLOAD,
            ],
        ]);

        // Đặt access type là offline để nhận được refresh token
        $client->setAccessType('offline');

        // Tạo liên kết xác thực lại
        $authUrl = $client->createAuthUrl();

        // Chuyển hướng người dùng đến trang xác thực Google
        return redirect($authUrl);
    }

}
