<?php

namespace App\Http\Controllers;

use App\Service;
use App\Pricelist;
use App\PricelistSellable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $index_url = "/services";
        $api_url = "/api/services";
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
            'name' => 'price_edit_enabled',
            'sortField' => 'price_edit_enabled',
            'title' => 'Price Edit',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'callback' => 'edify',
        ],
        
        [
            'name' => 'id',
            'title' => 'Details',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'callback' => 'linkify',
        ],
    ]);

        return view('services.index', compact('index_url', 'api_url', 'per_page', 'fields'));
    }

    public function create()
    {
        $pricelists = Pricelist::get();

        return view('services.create', compact('pricelists'));
    }

    public function store(Request $request)
    {
        $pricelists = Pricelist::all();

        DB::transaction(function () use ($request, $pricelists) {
            $service = Service::create([
                'name' => $request->service_name,
            ]);

            foreach ($pricelists as $x)
            {
                PricelistSellable::create([
                    'pricelist_id' => $x->id,
                    'sellable_id' => $service->id,
                    'sellable_type' => 'App\\Service',
                    'price' => $request[$x->name],
                ]);
            }
        });

        return redirect('/services');
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $pricelists = Pricelist::get();

        return view('services.edit', compact('service', 'pricelists'));
    }

    public function update(Request $request, Service $service)
    {
        $pricelists = Pricelist::all();

        DB::transaction(function () use ($request, $service, $pricelists) {
            $service->name = $request->service_name;
            $service->price_edit_enabled = $request->price_edit_enabled ? 1 : 0;
            $service->save();

            foreach ($pricelists as $x)
            {
                $p = PricelistSellable::where('pricelist_id', $x->id)
                                    ->where('sellable_id', $service->id)
                                    ->where('sellable_type', 'App\\Service')
                                    ->update(['price' => $request[$x->name] ]);
            }
            
        });

        return redirect('/services/' . $service->id);
    }

    public function deactivate(Service $service)
    {
        $service->is_active = 0;
        $service->save();

        return back();
    }

    public function activate(Service $service)
    {
        $service->is_active = 1;
        $service->save();

        return back();
    }
}
