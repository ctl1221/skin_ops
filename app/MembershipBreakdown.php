<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipBreakdown extends Model
{
    protected $guarded = [];
    
    public function sellable()
    {
    	return $this->morphTo();
    }
}
