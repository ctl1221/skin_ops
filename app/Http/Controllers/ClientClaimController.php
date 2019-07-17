<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\ClientClaim;
use App\History;
use App\PackageBreakdown;
use App\Service;
use App\Branch;
use App\Employee;

class ClientClaimController extends Controller
{
    public function edit(ClientClaim $claim)
    {
    	$branches = Branch::where('is_active',1)->get();
        $employees = Employee::all();
        $services = Service::where('is_active',1)->get();

        return view('client_claims.edit', compact('claim', 'branches', 'employees', 'services'));
    }

    public function update(Request $request, ClientClaim $claim)
    {
        $claim->claimed_by_date = $request->claimed_by_date;
        $claim->treated_by_id = $request->treated_by_id;
        $claim->branch_id = $request->branch_id;
        $claim->notes = $request->notes;

        $claim->save();

        return redirect('/clients/' . $claim->parent->client->id )->with(['message' => 'Client Claim Updated', 'message_type' => 'success']);;
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
