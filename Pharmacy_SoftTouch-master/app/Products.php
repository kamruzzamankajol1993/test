<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    // PrimaryKey
    protected $primaryKey = 'p_id';

    public function details(){
        return $this->hasMany('App\Purchase_Detail','product_id','p_id');
    }
}
