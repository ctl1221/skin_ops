<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricelistSellable extends Model
{
    protected $guarded = [];
    
    protected $table = 'pricelist_sellable';

    public function sellable()
    {
    	return $this->morphTo();
    }

    public function pricelist()
    {
    	return $this->belongsTo(Pricelist::class);
    }
}
