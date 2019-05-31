<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientClaim extends Model
{
    protected $guarded = [];

    public function claimed_by()
    {
        return $this->belongsTo(Client::class, 'claimed_by_id');
    }

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

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function treated_by()
    {
        return $this->belongsTo(Employee::class, 'treated_by_id');
    }

    public function assisted_by()
    {
        return $this->belongsTo(Employee::class, 'assisted_by_id');
    }
}
