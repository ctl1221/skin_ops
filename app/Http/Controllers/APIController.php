<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function services(Request $request)
	{

		if($request->sort){
			list($sortCol, $sortDir) = explode('|', $request->sort);
			$services = \App\Service::orderBy($sortCol, $sortDir);
		}
		else {
			$services = \App\Service::orderBy('id', 'asc');
		}

		if($request->filter)
		{
			$services->where('name','like','%' . $request->filter . '%');
		}

		$per_page = $request->per_page ? (int) $request->per_page : null;

		return $services->paginate($per_page);
	}

	public function products(Request $request)
	{

		if($request->sort){
			list($sortCol, $sortDir) = explode('|', $request->sort);
			$products = \App\Product::orderBy($sortCol, $sortDir);
		}
		else {
			$products = \App\Product::orderBy('id', 'asc');
		}

		if($request->filter)
		{
			$products->where('name','like','%' . $request->filter . '%');
		}

		$per_page = $request->per_page ? (int) $request->per_page : null;

		return $products->paginate($per_page);
	}

	public function packages(Request $request)
	{

		if($request->sort){
			list($sortCol, $sortDir) = explode('|', $request->sort);
			$packages = \App\Package::orderBy($sortCol, $sortDir);
		}
		else {
			$packages = \App\Package::orderBy('id', 'asc');
		}

		if($request->filter)
		{
			$packages->where('name','like','%' . $request->filter . '%');
		}

		$per_page = $request->per_page ? (int) $request->per_page : null;

		return $packages->paginate($per_page);
	}

	public function employees(Request $request)
	{

		if($request->sort){
			list($sortCol, $sortDir) = explode('|', $request->sort);
			$employees = \App\Employee::orderBy($sortCol, $sortDir);
		}
		else {
			$employees = \App\Employee::orderBy('id', 'asc');
		}

		if($request->filter)
		{
			$employees->where('last_name','like','%' . $request->filter . '%')
					->orWhere('first_name','like','%' . $request->filter . '%');
		}

		$per_page = $request->per_page ? (int) $request->per_page : null;

		return $employees->with('branch')->paginate($per_page);
	}

	public function clients(Request $request)
	{

		if($request->sort){
			list($sortCol, $sortDir) = explode('|', $request->sort);
			$clients = \App\Client::orderBy($sortCol, $sortDir);
		}
		else {
			$clients = \App\Client::orderBy('id', 'asc');
		}

		if($request->filter)
		{
			$clients->where('last_name','like','%' . $request->filter . '%')
					->orWhere('first_name','like','%' . $request->filter . '%');
		}

		$per_page = $request->per_page ? (int) $request->per_page : null;

		return $clients->paginate($per_page);
	}

	public function sales_orders(Request $request)
	{

		$branch_id = \Auth::user()->branch_id;
		if($request->sort){
			list($sortCol, $sortDir) = explode('|', $request->sort);
			$sales_orders = \App\SalesOrder::with('client')->orderBy($sortCol, $sortDir);
		}
		else {
			$sales_orders = \App\SalesOrder::with('client')->orderBy('id', 'desc');
		}

		if($request->filter)
		{
			$sales_orders
				->where(function ($query) use ($request) {
	                $query->where('so_number','like','%' . $request->filter . '%')
					->orWhere('date','like','%' . $request->filter . '%')
					->orWhereHas('client', function ($q) use ($request) {
						$q->where('first_name','like','%' . $request->filter . '%');
					})
					->orWhereHas('client', function ($q) use ($request) {
						$q->where('last_name','like','%' . $request->filter . '%');
					});
	            });
		}

		$per_page = $request->per_page ? (int) $request->per_page : null;

		return $sales_orders->where('branch_id',\Auth::user()->branch_id)->paginate($per_page);
	}

	public function payments(Request $request)
	{
		if($request->sort){
			list($sortCol, $sortDir) = explode('|', $request->sort);
			$payments = \App\Payment::with('parent','payment_type')->orderBy($sortCol, $sortDir);
		}
		else {
			$payments = \App\Payment::with('parent','payment_type')->orderBy('id', 'desc');
		}

		$per_page = $request->per_page ? (int) $request->per_page : null;

		if($request->filter)
		{
			$payments
				->where(function ($query) use ($request) {
					$query->where('py_number','like','%' . $request->filter . '%')
						->orWhere('date','like','%' . $request->filter . '%')
						->orWhere('amount','like','%' . $request->filter . '%')
						->orWhereHas('payment_type', function ($q) use ($request) {
							$q->where('name','like','%' . $request->filter . '%');
						});
				});
		}

		$per_page = $request->per_page ? (int) $request->per_page : null;

		return $payments->where('branch_id',\Auth::user()->branch_id)->paginate($per_page);
	}

	public function client_search(Request $request)
	{
		$last_name = str_replace("%", "", $request->last_name);
		$first_name = str_replace("%", "", $request->first_name);

		if($last_name && $first_name)
		{
			$clients = \App\Client::where('last_name', 'like', '%' . $last_name . '%')
				->where('first_name', 'like', '%' . $first_name . '%')
				->where('is_active',1)
				->get();
		}

		return $clients;
	}

	public function appointments()
	{
		$branch_id = \Auth::user()->branch->id;
		$start = \Carbon\Carbon::now()->addMonth(-6);

		return \App\Appointment::where('branch_id',$branch_id)
				->where('start', '>=', $start)
				->orderBy('start','asc')->get();
	}

	public function daily_total_sales(Request $request)
	{
		$total = 0;

		$sales_orders = \App\SalesOrder::with('sales_order_lines')
							->where('branch_id', $request->branch_id)
							->where('date', $request->date)
							->where('is_posted',1)
							->get();

		foreach($sales_orders as $x)
		{
			$total += $x->total_pay();
		}

		return $total;
	}

	public function daily_booky(Request $request)
	{
		$total = 0;

		$sales_orders = \App\SalesOrder::with('sales_order_lines')
							->where('branch_id', $request->branch_id)
							->where('date', $request->date)
							->where('is_posted',1)
							->get();

		foreach($sales_orders as $x)
		{
			foreach($x->payments as $y)
	        {
	            if($y->payment_type->name == 'Booky Cash' || $y->payment_type->name == 'Booky Card')
	            {
	                $total += $y->amount;
	            }
	        }		
		}

		return $total;
	}

	public function daily_skin_consultation(Request $request)
	{
		$total = 0;

		$sales_orders = \App\SalesOrder::with('sales_order_lines')
							->where('branch_id', $request->branch_id)
							->where('date', $request->date)
							->where('is_posted',1)
							->get();

		foreach($sales_orders as $x)
		{
			foreach($x->sales_order_lines as $y)
			{
				if($y->sellable->name == 'Skin Consultation')
				{
					$total += $y->price;
				}
			}	
		}

		return $total;
	}

	public function daily_dental_consultation(Request $request)
	{
		$total = 0;

		$sales_orders = \App\SalesOrder::with('sales_order_lines')
							->where('branch_id', $request->branch_id)
							->where('date', $request->date)
							->where('is_posted',1)
							->get();

		foreach($sales_orders as $x)
		{
			foreach($x->sales_order_lines as $y)
			{
				if($y->sellable->name == 'Dental Consultation')
				{
					$total += $y->price;
				}
			}	
		}

		return $total;
	}

	public function daily_services(Request $request)
	{
		$probeauty_ids = \App\Category::where('name','ProBeauty')->first()->items->pluck('sellable_id')->toArray();
		$total = 0;

		$sales_orders = \App\SalesOrder::with('sales_order_lines')
							->where('branch_id', $request->branch_id)
							->where('date', $request->date)
							->where('is_posted',1)
							->get();

		$payments = \App\Payment::where('branch_id', $request->branch_id)
                ->where('parent_type', 'App\\Client')
                ->where('date', $request->date)
                ->get();

		foreach($sales_orders as $x)
		{
			foreach($x->sales_order_lines as $y)
			{
				if($y->sellable_type == "App\Service" || $y->sellable_type == "App\Package" || $y->sellable_type == "App\Membership")
				{
					$total += $y->price;
				}

				if($y->sellable_type == "App\Package")
				{
					foreach($y->sellable->breakdowns as $z)
					{
						if($z->sellable_type == "App\Product" && in_array($z->sellable_id, $probeauty_ids))
						{
							$total -= \App\PricelistSellable::where('sellable_type',"App\Product")
									->where('pricelist_id',3)
									->where('sellable_id',$z->sellable_id)
									->first()
									->price;
						}
					}

				}
			}

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

	        $total -= $x->payableamount;
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

	public function daily_products(Request $request)
	{
		$total = 0;

		$ids = \App\Category::where('name','ProBeauty')->first()->items->pluck('sellable_id')->toArray();

		$sales_orders = \App\SalesOrder::with('sales_order_lines')
							->where('branch_id', $request->branch_id)
							->where('date', $request->date)
							->where('is_posted',1)
							->get();

		foreach($sales_orders as $x)
		{
			foreach($x->sales_order_lines as $y)
			{
				if($y->sellable_type == "App\Product")
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

	public function daily_probeauty(Request $request)
	{
		$ids = \App\Category::where('name','ProBeauty')->first()->items->pluck('sellable_id')->toArray();

		$total = 0;

		$sales_orders = \App\SalesOrder::with('sales_order_lines')
							->where('branch_id', $request->branch_id)
							->where('date', $request->date)
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

	public function daily_dental(Request $request)
	{
		$service_ids = \App\Category::where('name','Dental')->first()->items
						->where('sellable_type','App\Service')->pluck('sellable_id')->toArray();

		$package_ids = \App\Category::where('name','Dental')->first()->items
				->where('sellable_type','App\Package')->pluck('sellable_id')->toArray();

		$total = 0;

		$sales_orders = \App\SalesOrder::with('sales_order_lines')
							->where('branch_id', $request->branch_id)
							->where('date', $request->date)
							->where('is_posted',1)
							->get();

		foreach($sales_orders as $x)
		{
			foreach($x->sales_order_lines as $y) 
			{
				if($y->sellable_type == "App\Service" && in_array($y->sellable_id, $service_ids))
				{
					$total += $y->price;
				}

				if($y->sellable_type == "App\Package" && in_array($y->sellable_id, $package_ids))
				{
					$total += $y->price;
				}
			}	
		}

		return $total;
	}
}
