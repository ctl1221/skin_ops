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
			$services
				->where('name','like','%' . $request->filter . '%')
				->orWhere('is_active', $request->filter == "active" ? 1: 0 );
		}

		$per_page = $request->per_page ? (int) $request->per_page : null;

		return $services->paginate($per_page);
	}
}
