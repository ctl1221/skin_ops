<?php

namespace App\Http\Controllers;

use App\Product;
use App\Pricelist;
use App\PricelistSellable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $index_url = "/products";
        $api_url = "/api/products";
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

        return view('products.index', compact('index_url', 'api_url', 'per_page', 'fields'));
    }

    public function create()
    {
        $pricelists = Pricelist::get();

        return view('products.create', compact('pricelists'));
    }

    public function store(Request $request)
    { 
        $pricelists = Pricelist::all();

        DB::transaction(function () use ($request, $pricelists) {
            $product = Product::create([
                'name' => $request->product_name,
            ]);

            foreach ($pricelists as $x)
            {
                PricelistSellable::create([
                    'pricelist_id' => $x->id,
                    'sellable_id' => $product->id,
                    'sellable_type' => 'App\\Product',
                    'price' => $request[$x->name],
                ]);
            }
        });

        return redirect('/products');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $pricelists = Pricelist::get();

        return view('products.edit', compact('product', 'pricelists'));
    }

    public function update(Request $request, Product $product)
    {
        $pricelists = Pricelist::all();

        DB::transaction(function () use ($request, $product, $pricelists) {
            $product->name = $request->product_name;
            $product->price_edit_enabled = $request->price_edit_enabled ? 1 : 0;
            $product->save();

            foreach ($pricelists as $x)
            {
                $p = PricelistSellable::where('pricelist_id', $x->id)
                                    ->where('sellable_id', $product->id)
                                    ->where('sellable_type', 'App\\Product')
                                    ->update(['price' => $request[$x->name] ]);
            }
            
        });

        return redirect('/products/' . $product->id);
    }

    public function deactivate(Product $product)
    {
        $product->is_active = 0;
        $product->save();

        return back();
    }

    public function activate(Product $product)
    {
        $product->is_active = 1;
        $product->save();

        return back();
    }
}
