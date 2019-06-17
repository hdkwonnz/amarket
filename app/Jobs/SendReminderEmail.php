<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail; ////
use App\Mail\MailSending; ////

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderDetails; //from OrderController
    protected $cartNum; //from OrderController

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderDetails, $cartNum)
    {
        $this->orderDetails = $orderDetails;
        $this->cartNum = $cartNum;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->cartNum)->send(new MailSending($this->orderDetails));
    }
}
