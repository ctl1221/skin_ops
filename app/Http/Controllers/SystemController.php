<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Branch;

class SystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function m_dashboard(Request $request)
    {
        if(!$request->has('period'))
        {
            return redirect('/m_dashboard?period=current');
        }

        $branches = Branch::where('is_active', 1)->get();
        $dates = [];

        if($request->period == 'current')
        {
            $period_to_show = 'current';
        	
        	$date_to = Carbon::now();
        	$date_from = $date_to->year . '-';
        	
            if($date_to->month >= 10)
            {
                $date_from .= $date_to->month;
            }
            else
            {
                $date_from .= '0';
                $date_from .= $date_to->month;
            }
            $date_from .= '-01';

            $date_from = new Carbon($date_from);

        	$period = CarbonPeriod::create($date_from, $date_to);

        	foreach($period as $x)
        	{
        		array_push($dates, $x->format('Y-m-d'));
        	}

        	$dates = array_reverse($dates);
        
        }

        else {
            $date_from = new Carbon('first day of last month');
            $date_to = new Carbon('last day of last month');
            $period_to_show = 'previous';
            $period = CarbonPeriod::create($date_from, $date_to);

            foreach($period as $x)
            {
                array_push($dates, $x->format('Y-m-d'));
            }

            $dates = array_reverse($dates);
        }
    	
    	return view('systems.m_dashboard', compact('branches', 'dates','period_to_show'));
    }
}
