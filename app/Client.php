<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $guarded = [];

    protected $appends = ['fullname', 'pricelist_name'];

    public function getFullnameAttribute()
    {
        return '<a href="/clients/' . $this->id . '">' . 
            $this->display_name() . 
            "</a>";
    }

    public function getPricelistNameAttribute()
    {
        return $this->pricelist->name;
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
        return $this->hasManyThrough(SalesOrderLine::class, SalesOrder::class)
                ->orderBy('date','desc');
    }

    public function pricelist()
    {
        return $this->belongsTo(Pricelist::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class)->orderBy('date','desc');
    }

    public function payment_histories()
    {
        return $this->hasMany(History::class)->orderBy('date','asc');
    }

    public function last_visit()
    {
        $latest_visits = History::where('client_id',$this->id)->orderBy('date','desc')->get();

        $last_visit = 0;

        foreach($latest_visits as $x)
        {
            if($x->parent->claimed_by_id == $x->client_id)
            {
                $last_visit = $x->date;
                break;
            }
        }

        return $last_visit ? $last_visit : '---';
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
                    ->whereNull('claimed_by_id')
                    ->with('sellable')
                    ->get();
    }

    public function payables()
    {
        return $this->hasManyThrough(SalesOrderLine::class, SalesOrder::class);
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'parent');
    }

    public function payable_amount()
    {
        $sales_payments = 0;
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
                    $sales_payments += $y->amount;
                }
            }
        }

        $client_payments = 0;
        foreach($this->payments as $y)
        {
            $client_payments += $y->amount;
        }
        return $payables - $sales_payments - $client_payments;
    }
}
