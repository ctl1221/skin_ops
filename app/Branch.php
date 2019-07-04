<?php

namespace App;

use Carbon\Carbon;
use App\SalesOrder;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = [];

    public function currentMonthlySales()
    {
    	$total = 0;

    	$date_from = new Carbon('first day of this month');
    	$date_to = new Carbon('last day of this month');

    	$sales_orders = SalesOrder::where('branch_id', $this->id)
							->where('date','>=',$date_from->toDateString())
							->where('date','<=',$date_to->toDateString())
							->get();

		foreach($sales_orders as $sales_order)
		{
			$total += $sales_order->quota_included();
		}

    	return $total;

    }
}
