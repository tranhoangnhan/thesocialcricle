<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProxyController extends Controller
{
    public function cacheProxy(Request $request)
    {
        $url = $request->url;
        if ($url) {
            $cacheKey = 'image_' . md5($url);
            if (cache()->has($cacheKey)) {
                return cache()->get($cacheKey);
            }
            $driveUrl = base64_decode($url);
            $response = Http::get($driveUrl);
            dd($response);
            if ($response->failed()) {
                abort(404);
            }
            $headers = $response->headers();
            $cachedResponse = response($response->body())
                ->header('Content-Type', $headers['content-type'] ?? '')
                ->header('Content-Length', $headers['content-length'] ?? '')
                ->header('Cache-Control', 'public, max-age=86400') // Cache for 24 hours (24 * 60 * 60 seconds)
                ->header('Expires', gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT') // Expires in 24 hours
                ->header('ETag', '"' . ($headers['etag'] ?? '') . '"');
            cache()->put($cacheKey, $cachedResponse, now()->addDay()); // Cache for 24 hours
            return $cachedResponse;
        }
    }


}
