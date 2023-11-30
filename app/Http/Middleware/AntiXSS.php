<?php

namespace App\Http\Middleware;

use Closure;
use App\Events\Clients\Users\AllUsersEvent;
use Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class AntiXSS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        //c1. Loại bỏ những thẻ trong html
        $input = $request->all();
        array_walk_recursive($input, function (&$value) {
            $value = strip_tags($value);
        });
        $request->merge($input);
        //check online
        if (Auth::check()) {
            $user_id = Auth::user()->user_id;
            $cacheKey = 'users_' . $user_id;
            $cacheStatusKey = 'user_status_' . $user_id;
            $expiration = 180; // Thời gian online trong giây
            Redis::set($cacheKey, now());
            Redis::expire($cacheKey, $expiration);
            $lastInteractionTime = Redis::get($cacheKey);
            if ($lastInteractionTime && now()->diffInMinutes($lastInteractionTime) >= 1) {
                if (Redis::get($cacheStatusKey) !== 'offline') {
                    $offlineTime = now();
                    Redis::set('offline_time_' . $user_id, $offlineTime->toDateTimeString());
                    Redis::setex($cacheStatusKey, $expiration, 'offline');
                    Event::dispatch(new AllUsersEvent('status', $user_id, 'offline', '', $offlineTime->toDateTimeString()));
                }
            } else {
                if (Redis::get($cacheStatusKey) !== 'online') {
                    Redis::setex($cacheStatusKey, $expiration, 'online');
                    $offlineTime = Redis::get('offline_time_' . $user_id);
                    Event::dispatch(new AllUsersEvent('status', $user_id, 'online', '', NULL));
                }
            }
        }


        //c2. Sử dụng thư viện

        // $config = HTMLPurifier_Config::createDefault();
        // $config->set('HTML.Allowed', '');
        // $config->set('Filter.Custom', []);
        // $purifier = new HTMLPurifier($config);
        // $input = $request->all();

        // if (isset($input['components'][0]['updates'])) {
        //     // Mã hóa dữ liệu trong phần "updates"
        //     $input['components'][0]['updates'] = array_map(function ($value) use ($purifier) {
        //         $cleanedValue = $purifier->purify($value);
        //         if (empty($cleanedValue)) {
        //             return '';
        //         }
        //         return $cleanedValue;
        //     }, $input['components'][0]['updates']);
        // }
        // $request->merge($input);

        $response = $next($request);
        // $response->header('X-XSS-Protection', '1');
        // $response->header('X-Frame-Options', 'sameorigin');
        // $response->header('X-Content-Type-Options', 'nosniff');
        // $response->header('Strict-Transport-Security', 'max-age=15552000; preload');
        // $response->header('X-Powered-By', 'TSONIT');
        return $response;
    }

}
