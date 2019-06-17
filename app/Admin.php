<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;
use App\Role;

class Admin extends Authenticatable
{
    use Notifiable;

    //Access Level Control을 위해 추가. 22/03/2019
    public function role()
    {
        return $this->belongsToMany(Role::class,'role_admins');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    //multi auth 위해 추가 21/03/2019
    //이곳에서 Notifications/AdminResetPasswordNotification.php에 있는 mail이 보내 지도록
    //launch 한다. 28/03/2019
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //column name을 'role' 주니 LoginController에서 error가 발새하여 'role_code' column 추가 26/03/2019
    protected $fillable = [
        'name', 'lastname', 'email', 'role_code', 'password', 'verifyToken',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
