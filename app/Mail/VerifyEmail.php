<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;                         //ubuntu->source file folder에서
use Illuminate\Mail\Mailable;                         //php artisan make:mail VerifyEmail 하면
use Illuminate\Queue\SerializesModels;                //app\Mail folder에 VerifyEmail.php가 생긴다.13/03/2019
use Illuminate\Contracts\Queue\ShouldQueue;
//use App\User; //youtube에서 강의 한 내용에는 use App\User;를 사용.나는 사용 중지.14/03/2019

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    //아래 public $user;는 RegisterController의 sendEmail($thisUser) function의
    //Mail::to($thisUser['email']->send(new verifyEmail($thisUser)));에서 왔다.
    //RegisterController의 $thisUser가 여기로 오면서 $user로 바뀌었다.13/03/2019
    //원래 youtube동영상에는 public $user;로 사용하게 되어 있으나 내 생각 과 달라 사용 중지.14/03/2019
    //youtube.com/watch?v=XdraIx9JaXw&list=PLe30vg_FG4OTO7KbQ6TByyY99AiSw1MDS&index=11 ==> 참조할것.

    //public $user;

    public $thisUser; //RegisterController의 sendEmail($thisUser) function에서 왔다. 14/03/2019
    //from RegisterConfirmEmail.php 25/03/2019 ==> queue 사용를 위해...

    /**
     * Create a new message instance.
     *
     * @return void
     */

    //아래는 youtube에서 사용한 내용. 사용 중지.14/03/2019
    //public function __construct(User $user)
    //{
    //    $this->user = $user;
    //}

    //아래는 내가 추가.14/03/2019
    public function __construct($thisUser)
    {

        $this->thisUser = $thisUser;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('사용자 등록 활성화 통보')
                    ->view('emails.askEmailVerification');
    }
}