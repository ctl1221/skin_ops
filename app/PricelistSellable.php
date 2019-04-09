<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricelistSellable extends Model
{
    protected $table = 'pricelist_sellable';

    public function sellable()
    {
    	return $this->morphTo();
    }
}
