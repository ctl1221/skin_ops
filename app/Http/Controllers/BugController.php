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
        $bugs = Bug::orderBy('created_at','asc')->paginate('8');

        return view('bugs.index', compact('bugs'));
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

        \Notification::send(\App\SkinProSlack::find(1) , new \App\Notifications\BugSubmitted($bug));

    	return redirect('/bugs/' . $bug->id);
    }

    public function show(Bug $bug)
    {
    	return view('bugs.show', compact('bug'));
    }

    public function close(Bug $bug)
    {
        $bug->status = 'Close';
        $bug->save();

        return back();
    }

    public function open(Bug $bug)
    {
        $bug->status = 'Open';
        $bug->save();

        return back();
    }

    public function delete(Bug $bug)
    {
        Storage::delete($bug->filepath);
        $bug->delete();
        
        return redirect('/bugs');
    }
}
