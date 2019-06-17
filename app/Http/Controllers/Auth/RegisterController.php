<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Traits\CaptchaTrait; //for reCaptcha
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /////////////////////////////////////////////////////////////
    /////reCaptcha 추가하기
    //1.App\Traits 폴더를 만든후 CaptchaTrait.php를 코딩한다.
    //2.루트디렉토리의 composer.json의 "require"섹션에 "google/recaptcha": "~1.1"을 추가.
    //3.터미널(vagrant ssh -> cd Code -> cd laravelMall -> cd laravelMall)에서
    //  "composer update"를 타입하여 dependencies를 추가.
    //4.".env" 파일과 "register.blade.php"에 필요한 내용 추가.
    //www.tuts.codingo.me/google-recaptcha-in-laravel-application 참조할것.
    /////////////////////////////////////////////////////////////

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        //내가 추가12/04/2019 ==> register 후에 same page에 session message를 보여준다.
        //$request->session()->flash('status', 'Registerd! But verify your email to activate your account');
        //return redirect()->back(); .

        //return $this->registered($request, $user) //원래 코드
        //                ?: redirect($this->redirectPath());

        return $this->registered($request, $user) //임시로 사용.13/04/2019
                        ?: redirect('profile');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    //protected function validator(array $data)
    //{
    //    return Validator::make($data, [
    //        'name' => ['required', 'string', 'max:255'],
    //        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //        'password' => ['required', 'string', 'min:8', 'confirmed'],
    //    ]);
    //}

    protected function validator(array $data)
    {
        //reCaptcha를 위하여 아래와 같이 변경하였음
        $data['captcha'] = $this->captchaCheck(); //App\Traits\CaptchaTrait

        $validator = Validator::make($data,
            [
                'name'       => ['required', 'string', 'max:255'],
                'lastname'   => ['required', 'string', 'max:255'], //lastname column을 추가.
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'g-recaptcha-response'  => 'required',
                'captcha'               => 'required|min:1'
            ],
            [
                'name.required'   => 'Name is required',
                'lastname.required'   => 'Last Name is required', //lastname column을 추가.
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
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'], //추가. User.php(model) -> protected $fillable 추가12/04/2019
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
