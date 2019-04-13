<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageBreakdown extends Model
{
    public function sellable()
    {
    	return $this->morphTo();
    }
}
