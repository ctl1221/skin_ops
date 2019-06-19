<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    protected $appends = ['fullname', 'p_type', 'doc_reference'];

    public function parent()
    {
    	return $this->morphTo();
    }

    public function getFullnameAttribute()
    {
    	if($this->parent_type == "App\\SalesOrder")
    	{
    		$x = \App\SalesOrder::find($this->parent_id);

    		return 
    			'<a href="/clients/' . $x->client_id . '">' . 
    				$x->client->display_name() . "</a>";
    	}
        else if($this->parent_type == "App\\Client")
        {
        	$x = \App\Client::find($this->parent_id);

        	return 
    			'<a href="/clients/' . $x->id . '">' . 
    				$x->display_name() . "</a>";
        }
    }

    public function getPTypeAttribute()
    {
        return $this->payment_type->name;
    }

    public function getDocReferenceAttribute()
    {
    	if($this->parent_type == "App\\SalesOrder")
    	{
    		$x = \App\SalesOrder::find($this->parent_id);
    		return $x->is_posted ? "SO " . $x->so_number : "DT " . $x->so_number;
    	}
        else if($this->parent_type == "App\\Client")
        	return "PY " . $this->py_number;
    }

    public function payment_type()
    {
    	return $this->belongsTo(PaymentType::class); 
    }

    public function client_name()
    {
        if($this->parent_type == 'App\\Client')
        {
            return $this->parent->display_name();
        }

        elseif($this->parent_type == 'App\\SalesOrder')
        {
            return $this->parent->client->display_name();
        }

        else
        {
            return "---";
        }

    }

    public function branch()
    {
    	return $this->belongsTo(Branch::class); 
    }
}
