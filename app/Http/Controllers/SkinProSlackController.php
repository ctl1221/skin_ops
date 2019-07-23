<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class SkinProSlackController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	return view('slacks.index');
    }

    public function daily_sales(Request $request)
    {
    	\Notification::send(\App\SkinProSlack::find(1) , new \App\Notifications\DailySalesNotification($request->date));

    	return back()->with(['message' => 'Slack Triggered Successfully', 'message_type' => 'success']);
    }
}
