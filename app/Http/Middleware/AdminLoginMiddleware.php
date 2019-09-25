<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $user = Auth::user();
            if ($user->level == 1)
                return $next($request);
            else
                return redirect()->route('loginadmin')->with('thongbao','bạn phải đăng nhập với quyền admin để vào trang này !');
        }
        else return redirect()->route('loginadmin')->with('thongbao','bạn phải đăng nhập với quyền admin để vào trang này !');
    }
}
