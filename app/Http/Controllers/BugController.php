<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Bug;

class BugController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index()
    {
        
    }

    public function create()
    {
        return view('bugs.create');
    }

    public function store(Request $request)
    {
    	$filepath = $request->file('file')->store('public/bugs');

    	$bug = Bug::create([
    		'title' => $request->title,
    		'details' => $request->details,
    		'filepath' => $filepath,
    		'user_id' => auth()->user()->id,
    	]);

    	return redirect('/bugs/' . $bug->id);
    }

    public function show(Bug $bug)
    {
    	return view('bugs.show', compact('bug'));
    }
}
