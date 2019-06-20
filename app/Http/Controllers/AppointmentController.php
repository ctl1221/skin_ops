<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('appointments.index');
    }

    public function store(Request $request)
    {
        $datetime_string = $request->date . ' ' . $request->time;
        $start = Carbon::parse($datetime_string);

    	Appointment::create([
    		'start' => $datetime_string,
    		'end' => $start->addHour(1),
    		'branch_id' => \Auth::user()->branch_id,
    		'title' => $request->title,
    		'content' => $request->content,
    		'class' => $request->color,
    	]);

    	return "success";
    }

    public function edit(Appointment $appointment, Request $request)
    {
    	$appointment->title=$request->title;
    	$appointment->content=$request->content;
    	$appointment->start=$request->start;
    	$appointment->end=$request->end;

    	$appointment->save();

    	return "success";
    }


    public function delete(Appointment $appointment)
    {
    	$appointment->delete();

    	return "success";
    }
}
