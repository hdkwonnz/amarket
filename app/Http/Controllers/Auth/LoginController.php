<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request; //추가. 14/03/2019
use Illuminate\Support\Facades\Auth; ////
use Validator;  ////
use App\Shoppingcart;    ////
use App\Exceptions\ShoppingCartException; ////08/04/2019

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////
    //아래에 있는 모든 코드들은 login을 할때 shopping cart를 체크하기 위해 customizing을 했음.26/03/2019
    //laravel에서 제공하는 기본 코드 AuthenticatesUsers.php는 원본대로 보존 되어 있음. 추후 composer로
    //package를 update 해도  AuthenticatesUsers.php 만 바뀌고 이곳에 있는 코드는 바뀌지 않음.

    //product/details.blade.php Ajax에서 call 한다.
    //아래 loginAjax는 5.2 버젼.혹시 문제가 생기면 5.8 login code로 바꿀 것.14/04/2019
    public function loginAjax(Request $request)
    {
        $okValidate = $this->validateLoginAjax($request);

        if ($okValidate){
            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($lockedOut = $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            $credentials = $this->credentials($request);

            if ($this->guard()->attempt($credentials, $request->has('remember'))) {
                //return $this->sendLoginResponse($request);

                //쿠키 값을 로그인 유저로 바꾸기 위해 Shoppingcart를 바꾸는 function을 콜 한다.
                $this->cartMigrate(); ///////

                return 1;

            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            if (! $lockedOut) {
                $this->incrementLoginAttempts($request);
            }

            //return $this->sendFailedLoginResponse($request);
            return 0;
        }

        return 0;
    }

    protected function validateLoginAjax(Request $request)
    {
        ////product/details.blade.php Ajax에서 email, password 가 넘어 왔다.
        $validator = Validator::make(
            array(
                'txtEmail2' => $request->email,
                'txtPassword2' => $request->password
            ),
            array(
                'txtEmail2'=>'required|max:30',
                'txtPassword2'=>'required|max:15'
            )
        );
        if ($validator->fails())
        {
            return 0;
        }

        return 1;
    }

    //로그인 후에 실제 user(cartNum: 이메일번호)를 Shoppingcart에 업데이트 시킨다.
    protected function cartMigrate()
    {
        try{
            $cartNum = '';
            $oldCartNum = '';

            //로그인 된 상태이면 email 번호가 cart 번호가 된다.
            if (!(Auth::guest()))
            {
                $cartNum = Auth::user()->email;
            }

            // 인증되지 않은 사용자이지만, 쿠키값이 있다면,
            //아래 session()앞에 $request를 붙이면 error가 남.이유 모름.10/04/2019
            //ShoppingcartController에서는 session()앞에 $request를 붙여도 관계 없음...
            if (session()->has('laravelShoppingCartID'))
            {
                $oldCartNum = session()->get('laravelShoppingCartID','default_value');
            }

            if ($cartNum != '' && $oldCartNum != '')
            {
                $carts = Shoppingcart::
                select('id','product_id','quantity')
                ->where('cartNum', '=', $oldCartNum)
                ->get();

                if ($carts){
                    foreach ($carts as $cart)
                    {
                        $cart->cartNum = $cartNum;

                        $cart->update();
                    }
                }
            }

            //해당 유저의 쇼핑카트에 들어 있는 상품수를 카운트하여 쿠키에 보관한다.
            //layouts/app.blade.php jquery에서 쿠키 값('laravelCartCount')을 찾아 보여 준다.
            $cartCount = Shoppingcart::select('id')
                ->where('cartNum','=',$cartNum)
                ->count();
            if ($cartCount){
                session()->put('laravelCartCount',$cartCount);
            }

            //return 1;
        }
        catch(\Throwable $exception){
            //dd('Exception block', $exception); //working
            //echo $exception->getMessage(); //working ==>2nd option...
            throw new ShoppingCartException; //best option...실제로는 이렇게 처리해야 한다.

            //$errorMessage = $exception->getMessage();
            //echo '<h3 style="color: blue;">Throwable Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        }
        catch (\Exception $exception) {
            //dd('Exception block', $exception); //working
            //echo $exception->getMessage(); //working ==>2nd option...
            throw new ShoppingCartException; //best option...실제로는 이렇게 처리해야 한다.

            //$errorMessage = $exception->getMessage();
            //echo '<h3 style="color: blue;">Exception Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        }

    }

    ////아래는 5.2 버젼의 login, logout
    //public function login(Request $request)
    //{
    //    $this->validateLogin($request);

    //    // If the class is using the ThrottlesLogins trait, we can automatically throttle
    //    // the login attempts for this application. We'll key this by the username and
    //    // the IP address of the client making these requests into this application.
    //    if ($lockedOut = $this->hasTooManyLoginAttempts($request)) {
    //        $this->fireLockoutEvent($request);

    //        return $this->sendLockoutResponse($request);
    //    }

    //    $credentials = $this->credentials($request);

    //    if ($this->guard()->attempt($credentials, $request->has('remember'))) {

    //        //쿠키 값을 로그인 유저로 바꾸기 위해 Shoppingcart를 바꾸는 function을 콜 한다.
    //        $this->cartMigrate();//////

    //        return $this->sendLoginResponse($request);
    //    }

    //    // If the login attempt was unsuccessful we will increment the number of attempts
    //    // to login and redirect the user back to the login form. Of course, when this
    //    // user surpasses their maximum number of attempts they will get locked out.
    //    if (! $lockedOut) {
    //        $this->incrementLoginAttempts($request);
    //    }

    //    return $this->sendFailedLoginResponse($request);
    //}

    ////아래는 5.2 버젼 logout
    //public function logout(Request $request)
    //{
    //    $this->guard()->logout();

    //    $request->session()->flush();

    //    $request->session()->regenerate();

    //    ////return redirect('/'); //원래 코드

    //    ////return redirect()->back(); //내가 추가 05/03/2019 ==> logout 후에 same page에 화면이 멈춘다.

    //    ////return redirect('/login'); //내가 추가 06/03/2019 ==> logout 후에 원래 login page로 간다.

    //    return redirect('/Auth/logoutLogin/index'); //내가 추가 06/03/2019 ==> logout 후에 돌아간다.
    //}

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            //쿠키 값을 로그인 유저로 바꾸기 위해 Shoppingcart를 바꾸는 function을 콜 한다.
            $this->cartMigrate();//////

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        //return $this->loggedOut($request) ?: redirect('/'); //원본 코드
        return $this->loggedOut($request) ?: redirect('/Auth/logoutLogin/index');
    }
}
