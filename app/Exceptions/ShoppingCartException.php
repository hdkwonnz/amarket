<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class ShoppingCartException extends Exception
{
    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    //public function report(Exception $exception)
    public function report()
    {
        //ShoppingCartController의 catch에서 "throw new ShoppingCartException;"를 활성화 시키면 아래가 작동한다.09/04/2019
        Log::info("ShoppingCartController==>Errors...");
        //dd('email or log');
        //dd($exception);

        //parent::report($exception);
    }

    ///**
    // * Render an exception into an HTTP response.
    // *
    // * @param  \Illuminate\Http\Request  $request
    // * @param  \Exception  $exception
    // * @return \Illuminate\Http\Response
    // */
    //public function render($request, Exception $exception)
    public function render()
    {
        //ShoppingCartController의 catch에서 "throw new ShoppingCartException;"를 활성화 시키면 아래가 작동한다.09/04/2019
        //원하는 view(error message view)로 redirect 할 수 있다.
        //return redirect('/'); //단지 예제이다.실제로는 error를 위한 view를 만들어야 한다.
        //dd($exception);
        //return response()->view('welcome');

        //return parent::render($request, $exception);
    }
}
