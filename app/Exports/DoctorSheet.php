<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

use \Maatwebsite\Excel\Sheet;

class DoctorSheet implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    private $doctor_name;
    private $doctor_id;
    private $date_start;
    private $date_end;

    public function __construct($doctor_id, $doctor_name, $date_start, $date_end)
    {
        $this->doctor_name = $doctor_name;
        $this->doctor_id = $doctor_id;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
    }

    public function title(): string
    {
        return $this->doctor_name;
    }

    public function view(): View
    {
        $doc_name = $this->doctor_name;
        $doc_id = $this->doctor_id;
        $date_start = $this->date_start;
        $date_end = $this->date_end;

        $sol_service = DB::table('sales_order_lines as sol')
                            ->select('so.so_number')
                            ->addSelect('c.last_name')
                            ->addSelect('c.first_name')
                            ->addSelect('s.name')
                            ->addSelect('so.date')
                            ->addSelect('so.or_number')
                            ->addSelect('so.cif_number')
                            ->addSelect('sol.price')
                            ->addSelect(DB::raw('CONCAT(e.last_name, ", ", e.first_name) as assistant '))
                            ->addSelect('so.notes')
                            ->join('sales_orders as so','so.id','=','sol.sales_order_id')
                            ->join('services as s','s.id','=','sol.sellable_id')
                            ->join('clients as c','c.id','=','so.client_id')
                            ->leftJoin('employees as e','e.id','sol.assisted_by_id')
                            ->where('sellable_type','App\\Service')
                            ->where(function ($query) use ($doc_id) {
                                $query
                                    ->where('sold_by_id', $doc_id)
                                    ->orWhere('treated_by_id', $doc_id);
                            })
                            ->where('so.date','>=', $date_start)
                            ->where('so.date','<=', $date_end)
                            ->get();
        return view('excels.doctors', compact('doc_name','sol_service','date_start','date_end'));
    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class  => function(BeforeExport $event) {
                $event->writer->setCreator('Skin Pro RS');
            },
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                $event->sheet->styleCells(
                    'A5:I5',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => 'FF000000'],
                            ],
                        ]
                    ]
                );
            },
        ];
    }   
}

Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
    $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
});

Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
    $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
});
