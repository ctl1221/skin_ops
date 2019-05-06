<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $guarded = [];

    public function parent()
    {
    	return $this->morphTo();
    }

}
