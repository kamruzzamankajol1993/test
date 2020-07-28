<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase_Master extends Model
{
    protected $table = 'purchase_masters';
    protected $guarded = [];
    public function details(){
       return $this->hasMany('App\Purchase_Detail','purchase_master_id','purchase_master_id');
    }

    public function supplier(){
        return $this->belongsTo('App\Suppliers');
    }
}
