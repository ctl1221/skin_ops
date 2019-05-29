<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
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

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function sales_orders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function sales_order_lines()
    {
        return $this->hasManyThrough(SalesOrderLine::class, SalesOrder::class);
    }

    public function pricelist()
    {
        return $this->belongsTo(Pricelist::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function last_visit()
    {
        $last_visit = History::latest()->first()->date;

        return $last_visit;
    }

    public function memberships()
    {
        return $this->belongsToMany(Membership::class, 'client_memberships')->withPivot('date_end')->orderBy('date_end', 'desc');
    }

    public function to_claims()
    {
        $sales_orders_id = $this->sales_orders->pluck('id');

        return \App\ClientClaim::where('parent_type','App\\SalesOrder')
                    ->whereIn('parent_id', $sales_orders_id)
                    ->with('sellable')
                    ->get();
    }

    public function payables()
    {
        return $this->hasManyThrough(SalesOrderLine::class, SalesOrder::class);
    }

    public function payable_amount()
    {
        $payments = 0;
        $payables = 0;

        foreach($this->sales_orders as $x)
        {
            if($x->is_posted)
            {
                foreach($x->sales_order_lines as $y)
                {
                    $payables += $y->price;
                }

                foreach($x->payments as $y)
                {
                    $payments += $y->amount;
                }
            }
        }

        return $payables - $payments;
    }
}
