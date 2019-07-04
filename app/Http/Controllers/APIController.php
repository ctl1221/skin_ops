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
					$query->orWhere('date','like','%' . $request->filter . '%')
					$query->orWhereHas('client', function ($q) use ($request) {
						$q->where('first_name','like','%' . $request->filter . '%');
					})
					$query->orWhereHas('client', function ($q) use ($request) {
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
			$payments->where('py_number','like','%' . $request->filter . '%')
					->orWhere('date','like','%' . $request->filter . '%')
					->orWhere('amount','like','%' . $request->filter . '%')
					->orWhereHas('payment_type', function ($query) use ($request) {
						$query->where('name','like','%' . $request->filter . '%');
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
}
