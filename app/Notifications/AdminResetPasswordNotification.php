<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

//multi auth를 위해 만든 코드. 21/03/2019
//아래 우측의 implements ShouldQueue 는 메일을 보낼때 queue 사용을 위해서 필요함
//queue 사용응 원치 않으면 제거할 것. 28/03/20191
//queue 사용시 ubuntu => source folder => php artisan queue:work --tries=4 을 type 할것
//참조:www.youtube.com/watch?v=ct56p3J42d0&list=PLe30vg_FG4OR3b24WlxeTWsj7Z2wOtYrH&index=22

class AdminResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $token; //반드시 선언 해야 한다(queue 사용을 위해서)

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
        //원래는 아래 내용 대로 massage가 보내져야 하나 artisan으로 루틴을 수정하여 한글로된 내용이
        //보내진다. php artisan vendor:publish --tag=laravel-notifications 실행하면
        //resources/views/vendor/notifications folder에 두개의 파일이 생긴다.
        //그중  email.blade.php를 수정 해서 한글로 바꾸었는데 실질적으로   email.blade.php에 있는
        //내용이 발송된다. 28/03/2019 //V5.8에서는 잠시 stop. 01/04/2019

        return (new MailMessage)
            ->line([
                'You are receiving this email because we received a password reset request for your account.',
                'Click the button below to reset your password:',
            ])
            ->action('Admin Reset Password', route('admin.password.reset', $this->token))
            ->line('If you did not request a password reset, no further action is required.');
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
