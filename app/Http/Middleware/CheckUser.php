<?php

namespace App\Http\Middleware;

use App\Events\Clients\Users\AllUsersEvent;
use App\Models\IntroductionModel;
use Closure;
use Event;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class CheckUser
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if ($request->route()->getName() == 'logout') {
                return $next($request);
            }
            if (auth()->user()->user_banned == 1 && $request->route()->getName() !== 'banned') {
                return redirect()->route('banned');
            }
            $check = 0;
            if (auth()->user()->user_email_verified != 0) {
                // dd('a');
                $check = 1;
            }


            if (auth()->user()->user_email_verified == 0 && $request->route()->getName() != 'verify') {
                return redirect()->route('verify');
            } else if ($request->route()->getName() != 'verify' && auth()->user()->turn_on_2fa == 1 && session('2fa_enabled', true)) {
                if ($request->route()->getName() !== 'verify_2fa' && $request->route()->getName() !== 'postVerify_2fa') {
                    return redirect(route('verify_2fa'));
                }
            }

            if ($check == 1) {
                $introduction = IntroductionModel::where('user_id', auth()->user()->user_id)->first();
                if ($request->route()->getName() !== 'introduction') {
                    if (empty($introduction) || $introduction) {
                        
                        if (empty($introduction->location) || empty($introduction->hometown)) {
                            return redirect()->route('introduction');
                        }
                    }
                }

            }

            // $user_id = Auth::user()->user_id;
            // $cacheKey = 'users_' . $user_id;
            // $cacheStatusKey = 'user_status_' . $user_id;
            // $expiration = 180; // Thời gian online trong giây
            // Redis::set($cacheKey, now());
            // Redis::expire($cacheKey, $expiration);
            // $lastInteractionTime = Redis::get($cacheKey);
            // if ($lastInteractionTime && now()->diffInMinutes($lastInteractionTime) >= 1) {
            //     if (Redis::get($cacheStatusKey) !== 'offline') {
            //         $offlineTime = now();
            //         Redis::set('offline_time_' . $user_id, $offlineTime->toDateTimeString());
            //         Redis::setex($cacheStatusKey, $expiration, 'offline');
            //         Event::dispatch(new AllUsersEvent('status', $user_id, 'offline','',$offlineTime->toDateTimeString()));
            //     }
            // } else {
            //     if (Redis::get($cacheStatusKey) !== 'online') {
            //         Redis::setex($cacheStatusKey, $expiration, 'online');
            //         $offlineTime = Redis::get('offline_time_' . $user_id);
            //         Event::dispatch(new AllUsersEvent('status', $user_id, 'online','',NULL));
            //     }
            // }
            return $next($request);
        }

        if ($request->route()->getName() === 'home') {
            return $next($request);
        }

        // Chuyển hướng về trang chủ nếu chưa đăng nhập
        return redirect()->route('home');
    }
}
