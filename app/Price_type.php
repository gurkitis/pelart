<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price_type extends Model
{
    public function sell_price()
    {
        $this->hasMany('App\Sale_price');
    }
    public function sale()
    {
        $this->hasMany('App\Sale');
    }
}
