<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buy_price extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
