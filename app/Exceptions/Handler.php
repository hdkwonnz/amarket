<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException; ////

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {

        parent::report($exception);

    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        return parent::render($request, $exception);

    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    //아래 function은 laravel5.4까지만 유효함. 5.5는 다음 비디오를 참조할 것.23/03/2019
    //www.youtube.com/watch?v=jgR7jLmuosc&list=PLe30vg_FG4OTO7KbQ6TByyY99AiSw1MDS&index=14
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        ////return redirect()->guest('login'); //원래 코드 15/03/2019

        ////multi auth를 위해 코드 추가 했음. 15/03/2019
        ////config/session.php의 lifetime에 의해서 logout 될 시에 redirect 될 path.04/04/2019
        $guard = array_get($exception->guards(),0);
        switch ($guard){
            case 'admin':
                ////return redirect()->guest(route('admin.login'));//비디오에는 이렇게 되어있음.04/04/2019
                return redirect("/"); //내가 추가.04/04/2019
                break;
            default:
                redirect()->guest(route('login'));
                break;
        }

        ////비디오 설명에서는 아래 코드를 코멘트 처리하고 위의 switch문을 새로 추가 하였으나
        ////그렇게 하면 wep.php 의 ->middleware('auth'); 에서 에러 발생.24/03/2019
        return redirect()->guest('login');


        ////아래는 laravel 5.5에 의한 새로운 코드이나 seller, editor를 동시에 사용 할 수 없어
        ////참고로 코딩만 하였다.28/05/2019
        ////www.youtube.com/watch?v=jgR7jLmuosc&list=PLe30vg_FG4OTO7KbQ6TByyY99AiSw1MDS&index=14
        //$guard = array_get($exception->guards(),0);
        ////dd($guard);
        //switch ($guard){
        //    case 'admin':
        //        $redirect = route('admin.login');
        //        break;
        //    default:
        //        $redirect = route('login');
        //        break;
        //}
        //return $request->expectsJson()
        //            ? response()->json(['message' => $exception->getMessage()], 401)
        //            : redirect()->guest($redirect);
    }
}
