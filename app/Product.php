<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $guarded = [];

	public function pricelists()
	{
		return $this->morphMany(PricelistSellable::class, 'sellable');
	}
}
