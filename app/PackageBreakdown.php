<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageBreakdown extends Model
{
	protected $guarded = [];
	
    public function sellable()
    {
    	return $this->morphTo();
    }
}
