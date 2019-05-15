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

    public function sales_orders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function pricelist()
    {
        return $this->belongsTo(Pricelist::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function memberships()
    {
        return $this->belongsToMany(Membership::class, 'client_memberships')->withPivot('date_end')->orderBy('date_end', 'desc');
    }

    public function payables()
    {
        return $this->hasManyThrough(SalesOrderLine::class, SalesOrder::class);
    }

    public function payable_amount()
    {
        $payments = 0;
        foreach($this->sales_orders as $x)
        {
            foreach($x->payments as $y)
            {
                $payments += $y->amount;
            }
        }

        return $this->payables->sum('price') - $payments;
    }
}
