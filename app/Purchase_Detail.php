<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase_Detail extends Model
{
    protected $table = 'purchase_details';
    protected $guarded = [];
    public function master(){
      return  $this->belongsTo('App\Purchase_Master','purchase_master_id','purchase_master_id');
    }

    public function product(){
        return $this->belongsTo('App\Products','product_id','p_id');
    }
}
