<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function first_option()
    {
    	return $this->hasMany('App\First_option');
    }

    public function second_option()
    {
    	return $this->hasMany('App\Second_option');
    }

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

    public function categoryd()
    {
    	return $this->belongsTo('App\Categoryd');
    }

    public function pictures()
    {
    	return $this->hasMany('App\Picture');
    }

    public function orderdetails()
    {
    	return $this->hasMany('App\Orderdetail');
    }

    public function shoppingcarts()
    {
    	return $this->hasMany('App\Shoppingcart');
    }
}
