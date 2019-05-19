<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;

class ReportController extends Controller
{
    public function create()
    {
    	return SnappyPdf::loadFile('http://www.github.com')->inline('github.pdf');
    }
}
