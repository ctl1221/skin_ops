<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;

class SystemController extends Controller
{
    public function m_dashboard()
    {
    	$branches = Branch::where('is_active', 1)->get();
    	return view('systems.m_dashboard', compact('branches'));
    }
}
