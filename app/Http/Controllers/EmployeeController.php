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
        $employees = Employee::orderBy('last_name','asc')->paginate('3');

        return view ('employees.index', compact('employees'));
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
