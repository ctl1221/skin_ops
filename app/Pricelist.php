<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
{
    protected $guarded = [];

    public function sellables()
    {
    	return $this->morphMany('App\Sellable', 'commentable');
    } 
}
