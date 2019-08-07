<?php

namespace App\Exports;
    
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Employee;

class DoctorExport implements WithMultipleSheets
{

    private $date_start;
    private $date_end;
    
    public function __construct($date_start, $date_end)
    {
        $this->date_start = $date_start;
        $this->date_end = $date_end;
    }

    public function sheets(): array
    {
        $sheets = [];
        $doctor_ids = Employee::where('is_doctor',1)->where('is_active',1)->get();

        foreach($doctor_ids as $x) {
            $sheets[] = new DoctorSheet($x->id, $x->display_name(),  $this->date_start,  $this->date_end);
        }

        return $sheets;
    }
}
