<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $guarded = [];

	public function getIsActiveAttribute($value)
    {
        return $value ? "Active" : "Inactive";
    }

	public function pricelists()
	{
		return $this->morphMany(PricelistSellable::class, 'sellable');
	}

}
