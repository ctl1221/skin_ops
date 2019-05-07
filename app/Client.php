<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $guarded = [];
	
    public function display_name()
    {
    	return $this->last_name . ", " . $this->first_name;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function pricelist()
    {
        return $this->belongsTo(Pricelist::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
