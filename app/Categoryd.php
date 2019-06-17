<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoryd extends Model
{
    public function categorya()
    {
    	return $this->belongsTo('App\Categorya');
    }
    public function categoryb()
    {
    	return $this->belongsTo('App\Categoryb');
    }
    public function categoryc()
    {
    	return $this->belongsTo('App\Categoryc');
    }  
    public function products()
    {
    	return $this->hasMany('App\Product');
    }
}
