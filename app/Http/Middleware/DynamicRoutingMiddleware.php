<?php

namespace App\Http\Middleware;

use App\Models\UsersModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DynamicRoutingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route('id');
        $check = UsersModel::where('user_id', $id)->first();
        $checkUsername = UsersModel::where('user_username', $id)->first();
        if (auth()->check()) {
            if (auth()->user()->user_email_verified == 0 && $request->route()->getName() !== 'verify') {
                return redirect()->route('verify');
            }
        }
        if (isset($id) && (isset($check) || isset($checkUsername))) {
            return $next($request);
        } else {
            abort(404);
        }
    }
}
