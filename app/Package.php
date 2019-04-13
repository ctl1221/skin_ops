<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function breakdowns()
    {
    	return $this->hasMany(PackageBreakdown::class);
    }
}
