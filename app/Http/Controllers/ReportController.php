<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Storage;

use App\Report;

class ReportController extends Controller
{
    public function index()
    {
    	return view('reports.index');
    }

    public function create()
    {
        return view('reports.create');
    	// $name = 'Charles';
    	// $pdf =  SnappyPdf::loadView('reports.pdf.test', compact('name'))->inline('test.pdf');

    	// Storage::disk('local')->put('reports.pdf', $pdf);
    }

    public function store(Request $request)
    {
        Report::create([
            'name' => $request->name,
            'from' => $request->from,
            'to' => $request->to,
            'user_id' => \Auth::id()
        ]);

        return back();
    }

    public function download()
    {
    	return Storage::download('reports.pdf');
    }
}
