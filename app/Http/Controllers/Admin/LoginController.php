<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; ////
use Illuminate\Http\Request; ////

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    //AuthenticatesUsers.php에서 copy 해서 수정하였음. 15/03/2019
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function showLoginFormForEditor()
    {
        return view('editor.login');
    }

    public function showLoginFormForSeller()
    {
        return view('seller.login');
    }

    //아래는 users table의 status column이 true(1)인지를 체크하기위해 추가. 14/03/2019
    //아래 function은 AuthenticatesUsers.php에서 copy해서 overwriting 시켰음.
    //AuthenticatesUsers.php에 똑같은 function이 존재한다.
    //참조:www.youtube.com/watch?v=JVqjh7WdJgE&list=PLe30vg_FG4OTO7KbQ6TByyY99AiSw1MDS&index=10
    protected function credentials(Request $request)
    {
        //return $request->only($this->username(), 'password'); //원래 코드
        return ['email'=>$request->{$this->username()}, 'password'=>$request->password,'status'=>'1'];
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Access Level Control를 위해 추가.  22/03/2019
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate(); //원래 코드

        $this->clearLoginAttempts($request); //원래 코드

        //추가 코드
        foreach ($this->guard()->user()->role as $role)
        {
        	if($role->name == 'admin'){
                return redirect('admin/home');
            }elseif($role->name == 'editor'){
                //return redirect('admin/editor'); //사용 중지 23/03/2019
                return redirect('editor/index');
            }elseif($role->name == 'seller'){
                //return redirect('admin/seller'); //사용 중지 23/03/2019
                return redirect('seller/index');
            }
        }

        //아래는 비디오 설명에는 없다...25/03/2019
        return $this->authenticated($request, $this->guard()->user()) //원래 코드
                ?: redirect()->intended($this->redirectPath());
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    //AuthenticatesUsers.php에서 copy 해서 수정하였음. 15/03/2019
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    //Access Level Control를 위해 추가.  22/03/2019
    //이 function은 비디오 설명에는 없는 부분
    public function logout(Request $request)
    {
        foreach ($this->guard()->user()->role as $role)
        {
        	if($role->name == 'admin'){
                $this->guard('admin')->logout();
                $request->session()->flush();
                $request->session()->regenerate();
                return redirect('/admin');
            }elseif($role->name == 'editor'){
                $this->guard('admin')->logout();
                $request->session()->flush();
                $request->session()->regenerate();
                return redirect('/editor');
            }elseif($role->name == 'seller'){
                $this->guard('admin')->logout();
                $request->session()->flush();
                $request->session()->regenerate();
                return redirect('/seller');
            }
        }

        //아래는 원래 코드 22/03/2019
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        //return redirect('/');
        return redirect('/Auth/logoutLogin/index');
    }
}
