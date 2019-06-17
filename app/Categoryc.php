<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoryc extends Model
{
    public function categorya()
    {
    	return $this->belongsTo('App\Categorya');
    }
    public function categoryb()
    {
    	return $this->belongsTo('App\Categoryb');
    }   
    public function categoryds()
    {
    	return $this->hasMany('App\Categoryd');
    }
    public function products()
    {
    	return $this->hasMany('App\Product');
    }
}
