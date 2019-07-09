<?php

namespace App;

use Carbon\Carbon;
use App\SalesOrder;
use App\Payment;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = [];

    public function currentMonthlySales($date_to)
    {
    	$total = 0;

    	$date_from = new Carbon('first day of this month');

    	$sales_orders = SalesOrder::where('branch_id', $this->id)
							->where('date','>=',$date_from->toDateString())
							->where('date','<=',$date_to->toDateString())
							->get();

        $payments = Payment::where('branch_id', $this->id)
                    ->where('parent_type', 'App\\Client')
                    ->where('date','>=',$date_from->toDateString())
                    ->where('date','<=',$date_to->toDateString())
                    ->get();

		foreach($sales_orders as $sales_order)
		{
			$total += $sales_order->quota_included();
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

    public function currentBranchQuota($date_to)
    {
        $total = 0;

        $date_from = new Carbon('first day of this month');

        $sales_orders = SalesOrder::where('branch_id', $this->id)
                            ->where('date','>=',$date_from->toDateString())
                            ->where('date','<=',$date_to->toDateString())
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
                    $total -= $payment->amount;
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

    public function monthlyItemSalesCount()
    {

        $array = [];

        $date_from = new Carbon('first day of this month');
        $date_to = new Carbon('last day of this month');

        $sales_orders = SalesOrder::where('branch_id', $this->id)
                            ->where('date','>=',$date_from->toDateString())
                            ->where('date','<=',$date_to->toDateString())
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
}
