<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    //rest password가 끝나고 email을 user에게 보내는 코드는 Notifications/AdminResetPasswordNotification.php에
    //있다. Admin.php(model)에서 launch 되도록 코딩되어 있다.Admin.php 참조 할 것.28/03/2019

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //multi auth를 위해 추가. 15/03/2019
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    //multi auth를 위해 ResetsPasswords.php에서 copy하여 overwriting. 15/03/2019
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  string  $response
     * @return \Illuminate\Http\Response
     */
    //multi auth를 위해 ResetsPasswords.php에서 copy하여 overwriting. 27/03/2019
    //아래 코드가 없으면 password rest link clik 후 reset에 성공하면 자동 로그인 되면서
    //어디로 가야 할 지 몰라 패닉에 빠진다('/' 으로 redirect 한다) 27/03/2019
    //이 부분은 비디오 설명에는 없다. 내가 추가한 코드...
    protected function sendResetResponse($response)
    {
        //추가 코드
        foreach ($this->guard()->user()->role as $role)
        {
        	if($role->name == 'admin'){
                return redirect('admin/home');
            }elseif($role->name == 'editor'){
                return redirect('editor/index');
            }elseif($role->name == 'seller'){
                return redirect('seller/index');
            }
        }

        return redirect($this->redirectPath())  //원래 코드 27/03/2019
                            ->with('status', trans($response));
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    //multi auth를 위해 추가 21/03/2019
    public function broker()
    {
        return Password::broker('admins');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    //multi auth를 위해 추가 21/03/2019
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
