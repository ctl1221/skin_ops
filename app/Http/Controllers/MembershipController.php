<?php

namespace App\Http\Controllers;

use App\Membership;
use App\MembershipBreakdown;
use App\PricelistSellable;
use App\Pricelist;
use App\Sellable;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $memberships = Membership::with('breakdowns','pricelists')->orderBy('name')->get();

        return view('memberships.index', compact('memberships'));
    }

    public function create()
    {
    	$sellables = Sellable::active();
        $membership_product = Product::find(1)->name;

    	return view('memberships.create', compact('sellables','membership_product'));
    }

    public function store(Request $request)
    {
    	$pricelists = Pricelist::all();

    	$membership_freebies = json_decode($request->package_grid_lines);

    	DB::transaction(function () use ($request, $pricelists, $membership_freebies) {

	    	$membership = Membership::create([
	                'name' => $request->membership_name, 
	                'days_valid' => $request->days_valid,
	                'is_active' => 1,
	                ]);
	    	
	    	MembershipBreakdown::create([
                'membership_id' => $membership->id,
                'sellable_type' => "App\\Product",
                'sellable_id' => 1,
                'quantity' => 1,
            ]);

	    	foreach($membership_freebies as $x)
            {
                MembershipBreakdown::create([
                'membership_id' => $membership->id,
                'sellable_type' => "App\\" . $x->sellable_type,
                'sellable_id' => $x->sellable_id,
                'quantity' => $x->quantity,
            ]);
            }

	    	foreach ($pricelists as $x)
            {
                PricelistSellable::create([
                    'pricelist_id' => $x->id,
                    'sellable_id' => $membership->id,
                    'sellable_type' => 'App\\Membership',
                    'price' => $request->price,
                ]);
            }
	    });

        return redirect('/memberships'); 
    }

    public function edit()
    {
        $memberships = Membership::all();

        return view('memberships.edit', compact('memberships'));
    }
}
