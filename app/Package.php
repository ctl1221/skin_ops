<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
	protected $guarded = [];

    public function breakdowns()
    {
    	return $this->hasMany(PackageBreakdown::class);
    }

    public function pricelists()
	{
		return $this->morphMany(PricelistSellable::class, 'sellable');
	}

	public function divisor()
	{
		return $this->breakdowns->sum('quantity');
	}
}
