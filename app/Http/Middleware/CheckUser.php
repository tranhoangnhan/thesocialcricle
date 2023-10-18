<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckUser
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if ($request->route()->getName() == 'logout') {
                return $next($request);
            }

            if (auth()->user()->user_email_verified == 0 && $request->route()->getName() !== 'verify') {
                return redirect()->route('verify');
            }

            if (auth()->user()->user_banned == 1 && $request->route()->getName() !== 'banned') {
                return redirect()->route('banned');
            }

            return $next($request);
        }

        if ($request->route()->getName() === 'home') {
            return $next($request);
        }

        // Chuyển hướng về trang chủ nếu chưa đăng nhập
        return redirect()->route('home');
    }
}
