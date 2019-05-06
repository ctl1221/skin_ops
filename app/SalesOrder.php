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
}
