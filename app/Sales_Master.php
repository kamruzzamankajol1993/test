<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_Master extends Model
{
    protected $table='sales_masters';
    protected $guarded=[];

    public function Saledetails(){
        return $this->hasMany('App\Sales_Detail','sales_master_id','sales_master_id');
    }

    public function customer(){
        return $this->belongsTo('App\Customers');
    }
}
