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
}
