<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function price_type()
    {
        return $this->belongsTo('App\Price_type');
    }
}
