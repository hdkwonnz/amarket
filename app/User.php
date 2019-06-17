<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\MailResetPasswordNotification; ////
use App\Notifications\VerifyEmailForNewUser; ////

//아래 implements MustVerifyEmail은 register 후에 email을 보내 verification을 하기 위해 수정.
//laravel 5.8 manual 참조. ==> www.youtube.com/watch?v=ivYxiCPjpqc 참조 01/04/2019
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    //이곳에서 Notifications/MailResetPasswordNotification.php에 있는 mail이 보내 지도록
    //launch 한다. 28/03/2019
    //원래는 아래 코드 없이도 reset password가 정상적으로 끝나면 user에게 mail이 보내지도록 기본 세팅이
    //되어있다.그러나 기본 세팅은 queue를 사용 할 수가 없어 transaction time이 길어 지는 불편함이 있어
    //아래를 추가 하였다.vendor/laravel/framework/src/illuminate/Auth/Passwords/CanResetPassword.php에서
    //copy 하였다.참조:www.thewebtier.com/laravel/modify-password-reset-email-text-laravel/
    //1.php artisan make:notification MailResetPasswordNotification
    //2.app\Notifications==>public function toMail($notifiable)을 modify한다.
    //3.vendor/laravel/framework/src/illuminate/Auth/Passwords/CanResetPassword.php에서
    //  public function sendPasswordResetNotification($token)을 copy하여 이곳에 paste한다.

    public function sendPasswordResetNotification($token)
    {
        //$this->notify(new MailResetPasswordNotification($token)); //13/04/2019

        $this->notify((new MailResetPasswordNotification($token))->delay(now()->addSeconds(10)));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    //아래는 User.php/MustVerifyEmail.php에서 copy.
    //모든 방법은 위와 동일. 01/04/2019
    //Notifications\VerifyEmailForNewUser.php로 가서 추가된 코드 확인
    public function sendEmailVerificationNotification()
    {
        //$this->notify(new Notifications\VerifyEmail); //원본 코드

        $this->notify((new VerifyEmailForNewUser)->delay(now()->addSeconds(10))); //13/04/2019
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
