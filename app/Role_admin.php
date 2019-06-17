<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_admin extends Model
{
    //처음에 Role_Admin으로 만들었다가 Role_admin으로 바꾸 었으니 나중에에
    //문제가 생기면 이 model을 다시 생성할 것...22/03/2019

    protected $fillable = [      
        'role_id', 'admin_id',
    ];
}