<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Branch;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $index_url = "employees";
        $api_url = "/api/employees";
        $per_page = 10;

        $fields = json_encode([
        [
            'name' => 'fullname',
            'sortField' => 'last_name',
            'title' => 'Name',
            'titleClass' => 'text-center',
            'dataClass' => 'text-left',
        ],

        [    
            'name' => 'branch.name',
            'sortField' => 'branch_id',
            'title' => 'Branch',
            'titleClass' => 'text-center',
            'dataClass' => 'text-left',
        ],

        [
            'name' => 'is_active',
            'sortField' => 'is_active',
            'title' => 'Status',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'callback' => 'badgify',
        ],
        
        [
            'name' => 'id',
            'title' => 'Details',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'callback' => 'linkify',
        ],
    ]);

        return view('employees.index', compact('index_url', 'api_url', 'per_page', 'fields'));
    }

    public function create()
    {
        $branches = Branch::where('is_active', '1')->get();

        return view('employees.create', compact('branches'));
    }

    public function store(Request $request)
    {
        Employee::create([
                'last_name' => $request->last_name, 
                'first_name' => $request->first_name,
                'branch_id' => $request->branch_id,
                'is_receptionist' =>$request -> receptionist ? 1 : 0,
                'is_doctor' =>$request -> doctor ? 1 : 0,
                'is_aesthetician' =>$request -> aesthetician ? 1 : 0,
                'is_administrator' =>$request -> administrator ? 1 : 0,
                ]);

        return redirect('/employees'); 
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $branches = Branch::where('is_active', '1')->get();

        return view('employees.edit', compact('employee','branches'));
    }

    public function update(Request $request, Employee $employee)
    {
        Employee::where('id', $employee->id)
                            ->update([
                                'last_name' => $request->last_name, 
                                'first_name' => $request->first_name,
                                'branch_id' => $request->branch_id,
                                'is_receptionist' =>$request -> receptionist ? 1 : 0,
                                'is_doctor' =>$request -> doctor ? 1 : 0,
                                'is_aesthetician' =>$request -> aesthetician ? 1 : 0,
                                'is_administrator' =>$request -> administrator ? 1 : 0,
                            ]);

        return redirect('/employees/' . $employee->id);

    }

   public function deactivate(Employee $employee)
    {
        $employee->is_active = 0;
        $employee->save();

        return back();
    }

    public function activate(Employee $employee)
    {
        $employee->is_active = 1;
        $employee->save();

        return back();
    }
}
