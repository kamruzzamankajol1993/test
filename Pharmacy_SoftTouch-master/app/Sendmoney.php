<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sendmoney extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
