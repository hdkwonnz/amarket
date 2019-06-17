<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class First_option extends Model
{
    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function second_options()
    {
    	return $this->hasMany('App\Second_option');
    }
}
