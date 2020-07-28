<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    public function purchase(){
        return $this->hasOne('App\Purchase_master');
    }
}
