<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientClaim extends Model
{
    protected $guarded = [];

    public function sellable()
    {
    	return $this->morphTo();
    }

    public function parent()
    {
    	return $this->morphTo();
    }

    public function category()
    {
    	return $this->morphTo();
    }
}
