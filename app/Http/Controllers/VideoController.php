<?php

use App\Http\Controllers\Controller;
;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        // Lấy video từ yêu cầu
        $video = $request->file('video');

        // Kiểm tra xem tệp tin video tồn tại và hợp lệ
        if (!$video || !$video->isValid()) {
            return redirect()->back()->with('error', 'Video không hợp lệ.');
        }

        // Khởi tạo Google Client và YouTube Service
        $client = new Google_Client();
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setAccessToken(config('google.access_token'));

        $youtube = new Google_Service_YouTube($client);

        // Tạo đối tượng Video
        $videoObject = new Google_Service_YouTube_Video();
        $videoObject->setSnippet([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'tags' => $request->input('tags'),
        ]);
        $videoObject->setStatus(['privacyStatus' => 'public']);

        // Tải video lên YouTube
        try {
            $response = $youtube->videos->insert('snippet,status', $videoObject, ['mediaUpload' => ['name' => 'video.mp4', 'mimeType' => 'video/*', 'data' => file_get_contents($video->getPathname())]]);

            // Video uploaded successfully.
            $videoId = $response->getId();
            return redirect()->back()->with('success', 'Video đã được upload thành công. ID: ' . $videoId);
        } catch (Exception $e) {
            // Handle the error.
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi upload video: ' . $e->getMessage());
        }
    }
}
