<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoryb extends Model
{    
    public function categorya()
    {
    	return $this->belongsTo('App\Categorya');
    }
    public function categorycs()
    {
    	return $this->hasMany('App\Categoryc');
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
