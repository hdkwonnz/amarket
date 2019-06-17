<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qaboard extends Model
{
    //public static $rules = [
    //    'title' => 'required',
    //    'content' => 'required'
    //];

    protected $fillable = [
    	'title', 'content'
    ];
}
