<?php

namespace App\Http\Controllers;

use App\Package;
use App\Pricelist;
use App\PricelistSellable;
use App\Sellable;
use App\PackageBreakdown;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $index_url = "/packages";
        $api_url = "/api/packages";
        $per_page = 10;

        $fields = json_encode([
        [
            'name' => 'name',
            'sortField' => 'name',
            'title' => 'Name',
            'titleClass' => 'text-center',
            'dataClass' => 'text-left',
        ],

        [
            'name' => 'is_active',
            'sortField' => 'is_active',
            'title' => 'Status',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'callback' => 'badgify',
        ],
        
        [
            'name' => 'id',
            'title' => 'View',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'callback' => 'linkify',
        ],
    ]);

        return view('packages.index', compact('index_url', 'api_url', 'per_page', 'fields'));
    }

    public function create()
    {
        $pricelists = Pricelist::all();
        $sellables = Sellable::everything(); 

        return view('packages.create', compact('pricelists', 'sellables'));
    }

    public function store(Request $request)
    {
        $pricelists = Pricelist::all();

        $package_grid_lines = json_decode($request->package_grid_lines);

        DB::transaction(function () use ($request, $package_grid_lines, $pricelists) {
            $p = Package::create([
                'name' => $request->package_name,
            ]);

            foreach($package_grid_lines as $x)
            {
                PackageBreakdown::create([
                'package_id' => $p->id,
                'sellable_type' => "App\\" . $x->sellable_type,
                'sellable_id' => $x->sellable_id,
                'quantity' => $x->quantity,
            ]);
            }

            foreach ($pricelists as $x)
            {
                PricelistSellable::create([
                    'pricelist_id' => $x->id,
                    'sellable_id' => $p->id,
                    'sellable_type' => 'App\\Package',
                    'price' => $request[$x->name],
                ]);
            }
        
        });

        return redirect('/packages');

    }

    public function show(Package $package)
    {
        $pricelists = Pricelist::all();
     
        return view ('packages.show', compact('package', 'pricelists'));
    }

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $pricelists = Pricelist::all();

        DB::transaction(function () use ($request, $package, $pricelists) {
            $package->name = $request->package_name;
            $package->save();

            foreach ($pricelists as $x)
            {
                $p = PricelistSellable::where('pricelist_id', $x->id)
                                    ->where('sellable_id', $package->id)
                                    ->where('sellable_type', 'App\\Package')
                                    ->update(['price' => $request[$x->name] ]);
            }
            
        });

        return redirect('/packages/' . $package->id);
    }

    public function deactivate(Package $package)
    {
        $package->is_active = 0;
        $package->save();

        return back();
    }

    public function activate(Package $package)
    {
        $package->is_active = 1;
        $package->save();

        return back();
    }
}
