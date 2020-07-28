<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_Detail extends Model
{
     protected $table='sales_details';
     protected $guarded=[];
    public function SaleMaster(){
        return  $this->belongsTo('App\Sales_Master','sales_master_id','sales_master_id');
    }
    public function product(){
        return $this->belongsTo('App\Products','product_id','p_id');
    }

    public function getExpireDate(){
        return $this->belongsTo('App\Purchase_Detail','batch_id','batch_id');
    }
}
