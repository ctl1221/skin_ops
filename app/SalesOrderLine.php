<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrderLine extends Model
{
    protected $guarded = [];

    public function sellable()
    {
    	return $this->morphTo();
    }
}
