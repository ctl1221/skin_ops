<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
    	return view('reports.index');
    }

    public function create()
    {
    	$name = 'Charles';
    	$pdf =  SnappyPdf::loadView('reports.pdf.test', compact('name'))->inline('test.pdf');

    	Storage::disk('local')->put('reports.pdf', $pdf);

    	return "Success";
    }

    public function download()
    {
    	return Storage::download('reports.pdf');
    }
}
