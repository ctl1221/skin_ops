<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Branch;

class SystemController extends Controller
{
    public function m_dashboard()
    {
    	$branches = Branch::where('is_active', 1)->get();
    	$dates = [];

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
    	
    	return view('systems.m_dashboard', compact('branches', 'dates'));
    }
}
