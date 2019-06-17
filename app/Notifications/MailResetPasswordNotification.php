<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

//아래 우측의 implements ShouldQueue 는 메일을 보낼때 queue 사용을 위해서 필요함
//queue 사용응 원치 않으면 제거할 것. 28/03/20191
//queue 사용시 ubuntu => source folder => php artisan queue:work --tries=4 을 type 할것
//참조:www.youtube.com/watch?v=ct56p3J42d0&list=PLe30vg_FG4OR3b24WlxeTWsj7Z2wOtYrH&index=22

class MailResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url('password/reset', $this->token))
            ->line('If you did not request a password reset, no further action is required.');

        //$link = url( "/password/reset/?token=" . $this->token );
        //return ( new MailMessage )
        //   ->view('reset.emailer')
        //   ->from('info@example.com')
        //   ->subject( 'Reset your password' )
        //   ->line( "Hey, We've successfully changed the text " )
        //   ->action( 'Reset Password', $link )
        //   ->attach('reset.attachment')
        //   ->line( 'Thank you!' );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
