<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function payment_type()
    {
    	return $this->belongsTo(PaymentType::class); 
    }
}
