<?php

namespace App\Http\Middleware;

use Closure;

class RevalidateBackHistory
{
    ////아래는 비디오(www.youtube.com/watch?v=wLkA1g2s65U)를 보고 로그아웃 후 다시 백하면 전 화면이 나타는
    ////문제를 해결 했음. 26/03/2019
    ////php artisan make:middleware RevalidateBackHistory
    ////open App\Http\Middleware/RevalidateBackHistory.php
    ////handle function을 수정.26/03/2019

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$response = $next($request);

        //return $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')
        //    ->header('Pragma', 'no-cache')
        //    ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');

        $response = $next($request);

        return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
    }
}
