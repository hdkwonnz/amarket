<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;                         //ubuntu->source file folder에서
use Illuminate\Mail\Mailable;                         //php artisan make:mail MailSending 하면
use Illuminate\Queue\SerializesModels;                //app\Mail folder에 MailSending.php가 생긴다.13/03/2019
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSending extends Mailable
{
    use Queueable, SerializesModels;

    public $orderDetails; //from OrderController(SendReminderEmail.php => 25/03/2019)

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderDetails)
    {

        $this->orderDetails = $orderDetails;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('상품 구매 내용')
                    ->view('emails.mailSending');
    }
}
