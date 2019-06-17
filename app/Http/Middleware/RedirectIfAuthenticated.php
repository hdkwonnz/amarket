<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //multi auth를 위해 수정 했음. 바로 아래가 원본코드. 15/03/2019
        //비디오 설명에서는 아래 코드를 코멘트 처리하고 아래 switch문을 새로 추가 하였으나
        //그렇게 하면 wep.php 의 ->middleware('auth'); 에서 에러 발생.24/03/2019
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        //multi auth를 위해 아래 코드 추가. 15/03/2019
        switch($guard){
            case 'admin':
                if (Auth::guard($guard)->check()){
                    return redirect('admin/home');
                }
                break;
            default:
                if (Auth::guard($guard)->check()){
                    return redirect('/home');
                }
                break;
        }

        return $next($request);
    }
}
