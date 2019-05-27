<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
    	Appointment::create([
    		'start' => Carbon::now(),
    		'end' => Carbon::now()->addHour(1),
    		'branch_id' => 1,
    		'title' => 'Charles Licup',
    		'content' => 'Basic facial',
    		'class' => 'appointment'
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
