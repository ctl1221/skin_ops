<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategorySellable;
use App\Service;
use App\Product;
use App\Package;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->category_name,
        ]);

        return redirect('/categories');
    }

    public function show(Category $category)
    {
        $services = Service::where('is_active', 1)
                            ->orderby('name', 'asc')
                            ->get();
        $products = Product::where('is_active', 1)
                            ->orderBy('name', 'asc')
                            ->get();
        $packages = Package::where('is_active', 1)
                            ->orderBy('name', 'asc')
                            ->get();

        $service_items = $category->items->where('sellable_type','App\\Service')->pluck('sellable_id')->toArray();
        $product_items = $category->items->where('sellable_type','App\\Product')->pluck('sellable_id')->toArray();
        $package_items = $category->items->where('sellable_type','App\\Package')->pluck('sellable_id')->toArray();

        return view('categories.show', compact('category','services','service_items', 'products', 'product_items', 'packages', 'package_items'));
    }

    public function edit(Category $category)
    {
        
    }

    public function update(Request $request, Category $category)
    {
        
    }

    
    public function destroy(Category $category)
    {
        
    }

    public function add_service(Category $category, Request $request)
    {
        CategorySellable::create([
            'category_id' => $category->id,
            'sellable_type' => "App\\Service",
            'sellable_id' => $request->service_id,
        ]);

        return back();
    }

    public function delete_service(Category $category, Service $service)
    {
        CategorySellable::where('category_id', $category->id)
            ->where('sellable_type','App\\Service')
            ->where('sellable_id',$service->id)
            ->delete();

        return back();
    }

    public function add_product(Category $category, Request $request)
    {
        CategorySellable::create([
            'category_id' => $category->id,
            'sellable_type' => "App\\Product",
            'sellable_id' => $request->product_id,
        ]);

        return back();
    }

    public function delete_product(Category $category, Product $product)
    {
        CategorySellable::where('category_id', $category->id)
            ->where('sellable_type','App\\Product')
            ->where('sellable_id',$product->id)
            ->delete();

        return back();
    }

    public function add_package(Category $category, Request $request)
    {
        CategorySellable::create([
            'category_id' => $category->id,
            'sellable_type' => "App\\Package",
            'sellable_id' => $request->package_id,
        ]);

        return back();
    }

    public function delete_package(Category $category, Package $package)
    {
        CategorySellable::where('category_id', $category->id)
            ->where('sellable_type','App\\Package')
            ->where('sellable_id',$package->id)
            ->delete();

        return back();
    }
}
