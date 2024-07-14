<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            return $next($request);
        }
        return redirect()->route('login')->with('error', 'Chỉ admin mới được vào trang này !');
        // return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để vào trang này');
    }
}
