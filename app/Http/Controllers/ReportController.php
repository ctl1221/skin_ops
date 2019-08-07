<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Report;
use App\Sequence;
use App\Branch;

use App\Exports\DoctorExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$reports = Report::latest()->paginate(20);

        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $branches = Branch::all();
        if(Report::latest()->first())
        {
            $report_id = Report::latest()->first()->id + 1;
        }

        else
        {
            $report_id = 1;
        }
        $default_name = 'Report ' . $report_id;

        return view('reports.create', compact('branches','default_name'));
    }

    public function store(Request $request)
    {
        $rt_number = Sequence::where('name','RT Number')->firstOrFail();
        $file_name = $rt_number->text_value . '.pdf';
        
        if($request->report_type == 'Sales')
        {
            if($request->branch == 'All Branches')
            {
                $this->All_Branches_Sales($request->from, $request->to, $file_name, $rt_number->text_value);
                $this->InsertReportToDB($request, $rt_number, $file_name);
            }

            else
            {

            }
        }

        elseif($request->report_type == "Doctor's Sales")
        {
            $file_name = $rt_number->text_value . '.xlsx';
            $this->All_Doctors_Report($request->from, $request->to, $file_name, $rt_number->text_value);
            $this->InsertReportToDB($request, $rt_number, $file_name);
        }
        else
        {
            return redirect('/reports');
        }

        return redirect('/reports');
    }

    public function download(Request $request)
    {
    	return Storage::download('reports/' . $request->file_name);
    }

    public function delete($rt_number)
    {
        Report::where('rt_number', $rt_number)->delete();
        $file_name = 'reports/' . $rt_number;
        Storage::delete($file_name);

        return redirect('/reports');
    }

    function All_Branches_Sales($from, $to, $file_name, $rt_number)
    {
        dispatch(function () use ($from, $to, $file_name, $rt_number) {
            $sales_order_lines = \App\SalesOrderLine::All();
            $data = compact('sales_order_lines');

            $pdf = SnappyPdf::loadView('reports.pdf.all_branches_sales',$data)->inline($file_name);
            Storage::disk('local')->put('reports/' . $file_name, $pdf);

            $report = Report::where('rt_number', $rt_number)->first();
            $report->is_generated = 1;
            $report->save();
        });
    }

    function All_Doctors_Report($from, $to, $file_name, $rt_number)
    {
        dispatch(function () use ($from, $to, $file_name, $rt_number) {
            Excel::store(new DoctorExport($from, $to), 'reports/' . $file_name);

            $report = Report::where('rt_number', $rt_number)->first();
            $report->is_generated = 1;
            $report->save();
        });
    }

    function InsertReportToDB($request, $rt_number, $filename)
    {
        DB::transaction(function () use ($request, $rt_number, $filename) {

          $current_rt_number = $rt_number->text_value;
          $rt_number->integer_value++;
          $rt_number->decimal_value++;
          $rt_number->text_value = $rt_number->integer_value;

          $rt_number->save();

            Report::create([
                'name' => $request->name,
                'from' => $request->from,
                'to' => $request->to,
                'type' => $request->report_type,
                'rt_number' => $current_rt_number,
                'branch' => $request->branch,
                'user_id' => \Auth::id(),
                'filename' => $filename,
            ]);
        });
    }
}
