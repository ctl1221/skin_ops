<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    protected $appends = ['fullname'];

    public function getFullnameAttribute()
    {
        return $this->display_name();
    }

    public function display_name()
    {
    	return $this->last_name . ", " . $this->first_name;
    }

    public function branch()
	{
		return $this->belongsTo(Branch::class);
	}
}
