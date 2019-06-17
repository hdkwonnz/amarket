<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\Facades\Lang; ////
use Illuminate\Support\Carbon; ////
use Illuminate\Support\Facades\URL; ////
use Illuminate\Support\Facades\Config; ////

//아래 우측의 implements ShouldQueue 는 메일을 보낼때 queue 사용을 위해서 필요함
//queue 사용응 원치 않으면 제거할 것. 01/04/20191
//queue 사용시 ubuntu => source folder => php artisan queue:work --tries=4 을 type 할것
//새로운 user가 register하면 verification을 위하여 email이 기본적으로(사실은 선택 사항임)보내 지는데
//아래 코드는 queue 사용,메일 내용 변경을 위해 overridding 하였다.

class VerifyEmailForNewUser extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    //아래는 MustVerifyEmail.php/sendEmailVerificationNotification()/(new Notifications\VerifyEmail)에서 copy
    public static $toMailCallback;

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
    //아래는 MustVerifyEmail.php/sendEmailVerificationNotification()/(new Notifications\VerifyEmail)에서 copy
    //내용을 한글로 바꾸어도 된다. 01/04/2019
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject(Lang::getFromJson('Verify Email Address'))
            ->line(Lang::getFromJson('Please click the button below to verify your email address.'))
            ->action(
                Lang::getFromJson('Verify Email Address'),
                $this->verificationUrl($notifiable)
            )
            ->line(Lang::getFromJson('If you did not create an account, no further action is required.'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    //아래는 MustVerifyEmail.php/sendEmailVerificationNotification()/(new Notifications\VerifyEmail)에서 copy
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            ['id' => $notifiable->getKey()]
        );
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    //아래는 MustVerifyEmail.php/sendEmailVerificationNotification()/(new Notifications\VerifyEmail)에서 copy
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
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
