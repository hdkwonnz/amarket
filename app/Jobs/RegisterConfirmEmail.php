<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail; ////
use App\Mail\VerifyEmail; ////

class RegisterConfirmEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $registeredUser;  //from RegisterController@sendEmail
    protected $registeredEmail; //from RegisterController@sendEmail

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($registeredUser, $registeredEmail)
    {
        $this->registeredUser = $registeredUser;
        $this->registeredEmail = $registeredEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->registeredEmail)->send(new VerifyEmail($this->registeredUser));
    }
}
