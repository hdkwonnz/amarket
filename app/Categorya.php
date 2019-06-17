<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorya extends Model
{
    public function categorybs()
    {
    	return $this->hasMany('App\Categoryb');
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
