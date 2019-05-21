<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $guarded = [];

    public function sales_order_lines()
    {
    	return $this->hasMany(SalesOrderLine::class);
    }

    public function payments()
    {
    	return $this->morphMany(Payment::class, 'parent');
    }

    public function client()
    {
    	return $this->belongsTo(Client::class);
    }

}
