<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
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

	public function sales_orders(Request $request)
	{

		if($request->sort){
			list($sortCol, $sortDir) = explode('|', $request->sort);
			$sales_orders = \App\SalesOrder::orderBy($sortCol, $sortDir);
		}
		else {
			$sales_orders = \App\SalesOrder::orderBy('id', 'asc');
		}

		if($request->filter)
		{
			$sales_orders->where('fullname','like','%' . $request->filter . '%');
		}

		$per_page = $request->per_page ? (int) $request->per_page : null;

		return $sales_orders->with('client')->paginate($per_page);
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
		return \App\Appointment::all();
	}
}
