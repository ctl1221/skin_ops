<?php

namespace App\Http\Controllers;

use App\Branch;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $branches = Branch::orderBy('name','asc')->get();

        return view ('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        Branch::create([
                'name' => $request->name, 
                'quota' => $request->quota,
                ]);

        return redirect('/branches'); 
    }

    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    public function update(Branch $branch, Request $request)
    {
        $branch->name = $request->name;
        $branch->quota = $request->quota;
        $branch->color =$request->color;

        $branch->save();

        return redirect ('/branches');
    }

    public function deactivate(Branch $branch)
    {
        $branch->is_active = 0;
        $branch->save();

        return back();
    }

    public function activate(Branch $branch)
    {
        $branch->is_active = 1;
        $branch->save();

        return back();
    }
}
