<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Second_option extends Model
{
    public function first_option()
    {
    	return $this->belongsTo('App\First_option');
    }

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}
