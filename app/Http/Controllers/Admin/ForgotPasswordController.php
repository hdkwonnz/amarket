<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Support\Facades\Password; ////

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    //multi auth를 위해 SendsPasswordResetEmails.php에서 copy하여 overwriting. 15/03/2019
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('admin.passwords.email');
    }

    public function showLinkRequestFormForEditor()
    {
        return view('editor.passwords.email');
    }

    public function showLinkRequestFormForSeller()
    {
        return view('seller.passwords.email');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    //multi auth를 위해 추가 21/03/2019
    public function broker()
    {
        return Password::broker('admins');  //providers ==> admins
    }
}
