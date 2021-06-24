<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
