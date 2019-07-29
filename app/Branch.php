<?php

namespace App;

use Carbon\Carbon;
use App\SalesOrder;
use App\Payment;
use App\ClientClaim;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = [];

    public function currentMonthlySales($date_to)
    {
    	$total = 0;

    	$date_from = $date_to->year . '-';
        if($date_to->month >= 10)
        {
            $date_from .= $date_to->month;
        }
        else
        {
            $date_from .= '0';
            $date_from .= $date_to->month;
        }
        $date_from .= '-01';

        $date_from = new Carbon($date_from);

    	$sales_orders = SalesOrder::where('branch_id', $this->id)
							->where('date','>=',$date_from->toDateString())
							->where('date','<=',$date_to->toDateString())
                            ->where('is_posted', 1)
							->get();

        $payments = Payment::where('branch_id', $this->id)
                    ->where('parent_type', 'App\\Client')
                    ->where('date','>=',$date_from->toDateString())
                    ->where('date','<=',$date_to->toDateString())
                    ->get();

		foreach($sales_orders as $sales_order)
		{
			$total += $sales_order->quota_included();

            foreach($sales_order->payments as $y)
            {
                if($y->payment_type->name == 'Booky Cash' || $y->payment_type->name == 'Booky Card')
                {
                    $total -= $y->amount;
                }
            }
		}

        foreach($payments as $payment)
        {
            if($payment->payment_type->is_direct)
            {
                $total += $payment->amount;
            }
        }

    	return $total;
    }

    public function currentProBeautySales($date_to)
    {
        $total = 0;

        $date_from = $date_to->year . '-';
        if($date_to->month >= 10)
        {
            $date_from .= $date_to->month;
        }
        else
        {
            $date_from .= '0';
            $date_from .= $date_to->month;
        }
        $date_from .= '-01';

        $date_from = new Carbon($date_from);

        $ids = \App\Category::where('name','ProBeauty')->first()->items->pluck('sellable_id')->toArray();

        $sales_orders = SalesOrder::where('branch_id', $this->id)
                            ->where('date','>=',$date_from->toDateString())
                            ->where('date','<=',$date_to->toDateString())
                            ->where('is_posted',1)
                            ->get();

        foreach($sales_orders as $x)
        {
            foreach($x->sales_order_lines as $y)
            {
                if($y->sellable_type == "App\Product" && in_array($y->sellable_id, $ids))
                {
                    $total += $y->price;
                }

                if($y->sellable_type == "App\Package")
                {
                    foreach($y->sellable->breakdowns as $z)
                    {
                        if($z->sellable_type == "App\Product" && in_array($z->sellable_id, $ids))
                        {
                            $total += \App\PricelistSellable::where('sellable_type',"App\Product")
                                    ->where('pricelist_id',3)
                                    ->where('sellable_id',$z->sellable_id)
                                    ->first()
                                    ->price;
                        }
                    }
                }   
            }
        }

        return $total;
    }

    public function currentBranchQuota($date_to)
    {
        $total = 0;

        $date_from = new Carbon('first day of this month');

        $sales_orders = SalesOrder::where('branch_id', $this->id)
                            ->where('date','>=',$date_from->toDateString())
                            ->where('date','<=',$date_to->toDateString())
                            ->where('is_posted', 1)
                            ->get();

        $payments = Payment::where('branch_id', $this->id)
                    ->where('parent_type', 'App\\Client')
                    ->where('date','>=',$date_from->toDateString())
                    ->where('date','<=',$date_to->toDateString())
                    ->get();

        foreach($sales_orders as $sales_order)
        {
            $total += $sales_order->quota_included();

            foreach($sales_order->payments as $x)
            {
                if($x->payment_type->name == 'Booky Card' || 
                $x->payment_type->name == 'Booky Cash')
                {
                    $total -= $x->amount;
                }
            }
        }

        foreach($payments as $payment)
        {
            if($payment->payment_type->is_direct)
            {
                $total += $payment->amount;
            }
        }

        return $total;
    }

    public function monthlyClaimsCount()
    {

        $array = [];

        $date_from = new Carbon('first day of this month');
        $date_to = new Carbon('last day of this month');

        $client_claims = ClientClaim::with('sellable')
                            ->where('branch_id', $this->id)
                            ->where('claimed_by_date','>=',$date_from->toDateString())
                            ->where('claimed_by_date','<=',$date_to->toDateString())
                            ->get();

        foreach($client_claims as $x)
        {
            if(!array_key_exists($x->sellable->name, $array))
            {
                $array[$x->sellable->name] = 0;
            }
            $array[$x->sellable->name] += 1;
        }
        arsort($array);

        return $array;
    }

    public function monthlyItemSalesCount()
    {

        $array = [];

        $date_from = new Carbon('first day of this month');
        $date_to = new Carbon('last day of this month');

        $sales_orders = SalesOrder::where('branch_id', $this->id)
                            ->where('date','>=',$date_from->toDateString())
                            ->where('date','<=',$date_to->toDateString())
                            ->where('is_posted', 1)
                            ->get();

        foreach($sales_orders as $x)
        {
            foreach($x->sales_order_lines as $y)
            {
                if(!array_key_exists($y->sellable->name, $array))
                {
                    $array[$y->sellable->name] = 0;
                }
                $array[$y->sellable->name] += 1;
            }
        }
        arsort($array);

        return $array;
    }

    public function currentOverallSales($date_to)
    {
        $total = 0;

        $date_from = $date_to->year . '-';
        if($date_to->month >= 10)
        {
            $date_from .= $date_to->month;
        }
        else
        {
            $date_from .= '0';
            $date_from .= $date_to->month;
        }
        $date_from .= '-01';

        $date_from = new Carbon($date_from);

        $sales_orders = SalesOrder::where('branch_id', $this->id)
                            ->where('date','>=',$date_from->toDateString())
                            ->where('date','<=',$date_to->toDateString())
                            ->where('is_posted',1)
                            ->get();

        $payments = Payment::where('branch_id', $this->id)
                    ->where('parent_type', 'App\\Client')
                    ->where('date','>=',$date_from->toDateString())
                    ->where('date','<=',$date_to->toDateString())
                    ->get();

        foreach($sales_orders as $x)
        {
            $total += $x->sales_order_lines->sum('price');

            foreach($x->payments as $y)
            {
                if($y->payment_type->is_subtractable)
                {
                    $total -= $y->amount;
                }

                if($y->payment_type->name == 'Deal Grocer Payment')
                {
                    $total -= $y->amount;
                }
            }
        }

        foreach($payments as $payment)
        {
            if($payment->payment_type->is_direct)
            {
                $total += $payment->amount;
            }
        }

        return $total;
    }
}

