<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function delivery()
    {
        return $this->hasMany('App\Delivery');
    }
    public function sale()
    {
        return $this->hasMany('App\Sale');
    }
    public function buy_price()
    {
        return $this->hasMany('App\Buy_price');
    }
    public function sale_price()
    {
        return $this->hasMany('App\Sale_price');
    }
}
