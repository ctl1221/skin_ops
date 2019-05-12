<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $guarded = [];

    public function breakdowns()
    {
    	return $this->hasMany(MembershipBreakdown::class);
    }
    
    public function pricelists()
	{
		return $this->morphMany(PricelistSellable::class, 'sellable');
	}

}
