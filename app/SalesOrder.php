<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $guarded = [];

    protected $appends = ['fullname', 'totalprice', 'payableamount', 'reference'];

    public function getFullnameAttribute()
    {
        return '<a href="/clients/' . $this->client_id . '">' . 
            $this->client->display_name() . 
            "</a>";
    }

    public function receptionist()
    {
        return $this->belongsTo(User::class, 'receptionist_id');
    }

    public function getTotalpriceAttribute()
    {
        return $this->total_price() - $this->total_discount();
    }

    public function getPayableamountAttribute()
    {
        return $this->total_price() - $this->total_pay() - $this->total_discount();
    }

    public function getReferenceAttribute()
    {
        $prefix = $this->is_posted ? "SO " : "DT ";

        return '<a href="/sales_orders/' . $this->id . '">' . 
            $prefix . $this->so_number . 
            "</a>";
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function sales_order_lines()
    {
    	return $this->hasMany(SalesOrderLine::class);
    }

    public function payments()
    {
    	return $this->morphMany(Payment::class, 'parent');
    }

    public function client()
    {
    	return $this->belongsTo(Client::class);
    }

    public function total_price()
    {
        $total = 0;

        foreach($this->sales_order_lines as $x)
        {
            $total += $x->price;
        }

        return $total;
    }

    public function total_pay()
    {
        $total = 0;

        foreach($this->payments as $x)
        {
            if($x->payment_type->is_direct || $x->payment_type->is_external)
            {
                $total += $x->amount;
            }
        }

        return $total;
    }

    public function total_discount()
    {
        $total = 0;

        foreach($this->payments as $x)
        {
            if($x->payment_type->is_subtractable)
            {
                $total += $x->amount;
            }
        }

        return $total;
    }

    public function quota_included()
    {
        $total = 0;
        $not_included_quota_amount = 0;
        foreach($this->sales_order_lines as $x)
        {
            if($x->sellable_type == 'App\\Service' && ($x->sellable->name == 'Skin Consultation' || $x->sellable->name == 'Dental Consultation') && $x->sales_order->is_posted)
            {
                $not_included_quota_amount += $x->price;
            }
        }

        foreach($this->payments as $x)
        {
            if($x->payment_type->is_direct && $x->parent->is_posted)
            {
                $total += $x->amount;
            }
        }

        return $total - $not_included_quota_amount;
    }

}
