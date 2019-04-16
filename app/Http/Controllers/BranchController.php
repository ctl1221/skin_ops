<?php

namespace App\Http\Controllers;

use App\Branch;

use Illuminate\Http\Request;

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
                'name' => $request->branch_name, 
                ]);

        return redirect('/branches'); 
    }

    public function show(Branch $branch)
    {
        //
    }

    public function edit(Branch $branch)
    {
        $branch = Branch::all();

        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $branch = Branch::all();

        foreach ($branch as $x)
        {
            Branch::where('id', $x->id)
                        ->update([
                            'name' => $request[$x->id],
                        ]);
        }
            
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
