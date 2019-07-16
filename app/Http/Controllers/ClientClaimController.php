<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\ClientClaim;
use App\History;
use App\PackageBreakdown;
use App\Service;

class ClientClaimController extends Controller
{
    public function show(ClientClaim $claim)
    {
    	return view('client_claims.show', compact('claim'));
    }

    public function unclaim(ClientClaim $claim)
    {

    	$make_your_own_service_id = Service::where('name', 'Make Your Own')->first()->id;

    	$make_own_package_ids = PackageBreakdown::where('sellable_type', 'App\\Service')
    						->where('sellable_id', $make_your_own_service_id)
    						->pluck('package_id')
    						->toArray();
    
    	DB::transaction(function () use ($claim, $make_your_own_service_id, $make_own_package_ids) {

    		History::where('parent_type','App\\ClientClaim')
    				->where('parent_id', $claim->id)
    				->delete();

    		$claim->claimed_by_id = null;
            $claim->branch_id =  null;
            $claim->treated_by_id = null;
            $claim->assisted_by_id = null;
            $claim->claimed_by_date = null;
            $claim->notes = null;

          	if($claim->category_type == 'App\\Package' 
          		&& in_array($claim->category_id, $make_own_package_ids))
          	{
          		$claim->sellable_id = $make_your_own_service_id;
          	}

            $claim->save();

    	});

    	return redirect('/clients/' . $claim->parent->client->id);
    }
}
