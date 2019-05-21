<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrderLine extends Model
{
    protected $guarded = [];

    public function sellable()
    {
    	return $this->morphTo();
    }

	public function seller()
    {
    	return $this->belongsTo(Employee::class, 'sold_by_id');
    }   

    public function treater()
    {
    	return $this->belongsTo(Employee::class, 'treated_by_id');
    } 

    public function assistant()
    {
    	return $this->belongsTo(Employee::class, 'assisted_by_id');
    }  
}
