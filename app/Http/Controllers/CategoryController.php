<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategorySellable;
use App\Service;

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
        $services = Service::all();

        $service_items = $category->items->where('sellable_type','App\\Service')->pluck('sellable_id')->toArray();

        return view('categories.show', compact('category','services','service_items'));
    }

    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
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
}
