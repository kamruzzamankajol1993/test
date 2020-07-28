<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public function customer_purchase(){
        return $this->hasMany('App\Sales_master');
    }
}
