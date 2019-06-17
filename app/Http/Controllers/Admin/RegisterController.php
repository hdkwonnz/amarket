<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Admin; ////
use App\Role_admin; ////
use App\Traits\CaptchaTrait; //for reCaptcha
use Illuminate\Support\Str;//vendor\laravel\framwork\src\illuminate\Auth\Password\DatabaseTokenRepository.php@createNewToken()13/03/2019
use Mail;                  //13/03/2019
use App\Mail\VerifyEmail;  //13/03/2019
use Session;               //15/03/2019
use Illuminate\Http\Request; //26/03/2019
use Illuminate\Support\Facades\Auth; //26/03/2019
use Illuminate\Auth\Events\Registered; //26/03/2019
use DB; ////

/////////////////////////////////////////////////////////////
/////reCaptcha 추가하기
//1.App\Traits 폴더를 만든후 CaptchaTrait.php를 코딩한다.
//2.루트디렉토리의 composer.json의 "require"섹션에 "google/recaptcha": "~1.1"을 추가.
//3.터미널(vagrant ssh -> cd Code -> cd laravelMall -> cd laravelMall)에서
//  "composer update"를 타입하여 dependencies를 추가.
//4.".env" 파일과 "register.blade.php"에 필요한 내용 추가.
//www.tuts.codingo.me/google-recaptcha-in-laravel-application 참조할것.
/////////////////////////////////////////////////////////////

//Email Verification 위해 코드를 추가하거나 변경 하였음.아래 링크 참조할 것.13/03/2019
//참조:www.youtube.com/watch?v=XdraIx9JaXw&list=PLe30vg_FG4OTO7KbQ6TByyY99AiSw1MDS&index=11
//model(User.php)수정을 위해 migration을 수행.database/migrations folder 참조 할 것.
//RegistersUsers.php, wep.php, views folder 수정 혹은 코드 추가.

//lastname column을 추가. 20/03/2019
//migration 수행.(add_lastname_column_users_table --table=users(database/migrations 참조)
//User.php(model) 수정.

//admin,editor,seller register를 위하여 코드를 추가 혹은 수정 하였음.26/03/2019

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, CaptchaTrait; //for reCaptcha

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest:admin');
    }

    ///**
    // * Get a validator for an incoming registration request.
    // *
    // * @param  array  $data
    // * @return \Illuminate\Contracts\Validation\Validator
    // */
    //원래 있던 코드 30/03/2019
    //protected function validator(array $data)
    //{
    //    return Validator::make($data, [
    //        'name' => ['required', 'string', 'max:255'],
    //        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //        'password' => ['required', 'string', 'min:8', 'confirmed'],
    //    ]);
    //}

    ///**
    // * Create a new user instance after a valid registration.
    // *
    // * @param  array  $data
    // * @return \App\User
    // */
    //원래 있던 코드 30/03/2019
    //protected function create(array $data)
    //{
    //    return User::create([
    //        'name' => $data['name'],
    //        'email' => $data['email'],
    //        'password' => Hash::make($data['password']),
    //    ]);
    //}

    //아래는 multi auth를 위하여 코드를 추가 혹은 수정. 23/03/2019
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function showRegistrationFormForSeller()
    {
        return view('seller.register');
    }

    public function showRegistrationFormForEditor()
    {
        return view('editor.register');
    }

    //multi auth를 위해 추가. 23/03/2019
    //RegistersUsers.php에서 copy. 원본은 그대로 RegistersUsers.php에 있다.
    public function register(Request $request)
    {
        //dd($request->all());

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user); //register가 끝나면 해당 user가 login한 상태로 home/index로 돌아감==>email verification을 위하여 stop.13/03/2019

        //return redirect(route('verifyEmailFirst')); //추가 13/03/2019 임시사용...

        //return redirect(route('login')); //추가 15/03/2019

        //return redirect(route('login')); //추가 15/03/2019

        if ($user->role_code == '3'){
            return redirect('seller/register'); //register 후 다시 register page로 돌아간다.26/03/2019
        }elseif ($user->role_code == '2'){
            return redirect('editor/register');
        }elseif ($user->role_code == '1'){
            return redirect('admin/register');
        }

        return redirect('/');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard() //for multi auth 26/03/2019
    {
        return Auth::guard('admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //reCaptcha를 위하여 아래와 같이 변경하였음
        $data['captcha'] = $this->captchaCheck(); //App\Traits\CaptchaTrait

        $validator = Validator::make($data,
            [
                'name'            => 'required|max:255',
                'lastname'            => 'required|max:255', //lastname column을 추가. 20/03/2019
                'email'                 => 'required|email|max:255|unique:admins', //users=>admins 26/03/2019
                'password'              => 'required|min:8|confirmed',
                'g-recaptcha-response'  => 'required',
                'captcha'               => 'required|min:1'
            ],
            [
                'name.required'   => 'Name is required',
                'lastname.required'   => 'Last Name is required', //lastname column을 추가. 20/03/2019
                'email.required'        => '이메일 is required',
                'email.email'           => '이메일 is invalid',
                'password.required'     => '비밀번호 is required',
                'password.min'          => '비밀번호 needs to have at least 6 characters',
                'g-recaptcha-response.required' => 'Captcha is required(로봇이 아닙니다에 체크하세요).',
                'captcha.min'           => 'Wrong captcha, please try again.(로봇이 아닙니다를 다시 체크하세요)'
            ]
        );

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        Session::flash('status', 'Registerd! But verify your email to activate your account'); //추가 15/03/2019

        //start the transaction
        DB::beginTransaction();

        try
        {
            $user = Admin::create([
                'name' => $data['name'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'role_code' => $data['role'],
                'password' => bcrypt($data['password']),//email verification 위하여 'verifyToken' 추가. 13/03/2019
                'verifyToken' => Str::random(40),//vendor\laravel\framwork\src\illuminate\Auth\Password\DatabaseTokenRepository.php@createNewToken()
            ]);

            $lastUserId = $user->id; //방금 만들어진 user id

            $role_admin=Role_admin::create([
                'role_id' => $data['role'],
                'admin_id' => $lastUserId,
                ]);

            if(!$user || !$role_admin)
            {
                throw new Exception("admin table creation error...");  //catch로 보낸다.
            }

            //make transaction commit
            DB::commit();

            $thisUser = Admin::findOrFail($user->id); //Email Verification 위해 추가.13/03/2019
            //$this->sendEmail($thisUser); //Email Verification 위해 추가.13/03/2019 ==>임시stop 26/03/2019
            return $user; //원래 본 function 맨 위에 있었음.(동일하게 작동함)14/03/2019
        }
        catch (Exception $e)
        {
            //transaction rollback
            DB::rollback();

            return "Failed to create Admin, Role_admin table..." + $e->getMessage();
        }
    }

    //Email Vreification위하여 추가.13/03/2019
    public function sendEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new VerifyEmail($thisUser));
    }

    //Email Vreification위하여 추가.13/03/2019 ==>임시사용==>현재 중지.15/03/2019
    //public function verifyEmailFirst()
    //{
    //    return view('emails.verifyEmailFirst');
    //}

    //Email Vreification위하여 추가.13/03/2019
    public function sendEmailDone($email,$verifyToken) //users table의 id를 받아서 처리 할 수도 있다.
    {
        $user = User::where(['email' => $email, 'verifyToken' => $verifyToken])->first();
        if ($user){
            User::where(['email' => $email, 'verifyToken' => $verifyToken])->update(['status'=>'1', 'verifyToken'=>NULL]);
            return "Completed email verification...";
        }
        else{
            return "User not found...";
        }
    }
}
