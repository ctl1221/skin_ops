<?php

namespace App\Http\Controllers;

use App\Package;
use App\Pricelist;
use App\PricelistSellable;
use App\Product;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PricelistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        $pricelists = Pricelist::all();

        return view('pricelists.index', compact('pricelists'));
    }

    public function create()
    {
        return view('pricelists.create');
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $pricelist = Pricelist::create([
                'name' => $request->pricelist_name,
            ]);

            $products = Product::all();
            $services = Service::all();
            $packages = Package::all();

            foreach($products as $x)
            {
                PricelistSellable::create([
                    'pricelist_id' => $pricelist->id,
                    'sellable_id' => $x->id,
                    'sellable_type' => 'App\\Product',
                    'price' => 0,
                ]);
            }

            foreach($services as $x)
            {
                PricelistSellable::create([
                    'pricelist_id' => $pricelist->id,
                    'sellable_id' => $x->id,
                    'sellable_type' => 'App\\Service',
                    'price' => 0,
                ]);
            }

            foreach($packages as $x)
            {
                PricelistSellable::create([
                    'pricelist_id' => $pricelist->id,
                    'sellable_id' => $x->id,
                    'sellable_type' => 'App\\Package',
                    'price' => 0,
                ]);
            }

    });

        return redirect('/pricelists');
    }

    public function edit()
    {
        $pricelists = Pricelist::all();

        return view ('pricelists.edit', compact('pricelists'));
    }

    public function update(Request $request, Pricelist $pricelist)
    {
        $pricelists = Pricelist::all();

        DB::transaction(function () use ($request, $pricelists) {
            foreach($pricelists as $x)
            {
                Pricelist::where('id', $x->id)
                            ->update([
                                'name' => $request[$x->id],
                            ]);
            }
        });

        return redirect('/pricelists');
    }

    public function deactivate(Pricelist $pricelist)
    {
        $pricelist->is_active = 0;
        $pricelist->save();

        return back();
    }

    public function activate(Pricelist $pricelist)
    {
        $pricelist->is_active = 1;
        $pricelist->save();

        return back();
    }
}
