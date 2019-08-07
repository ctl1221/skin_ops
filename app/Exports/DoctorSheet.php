<?php

namespace App\Exports;

use App\Package;
use App\SalesOrderLine;

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

    private $services_count;
    private $packages_count;
    private $memberships_count;
    private $sold_products_count;
    private $sold_services_count;
    private $sold_packages_count;
    private $sold_memberships_count;

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
                            ->addSelect('b.name as branch_name')
                            ->join('sales_orders as so','so.id','=','sol.sales_order_id')
                            ->join('services as s','s.id','=','sol.sellable_id')
                            ->join('clients as c','c.id','=','so.client_id')
                            ->join('branches as b','b.id','=','so.branch_id')
                            ->leftJoin('employees as e','e.id','sol.assisted_by_id')
                            ->where('sellable_type','App\\Service')
                            ->where(function ($query) use ($doc_id) {
                                $query
                                    ->where('sol.sold_by_id', $doc_id)
                                    ->orWhere('sol.treated_by_id', $doc_id);
                            })
                            ->where('so.date','>=', $date_start)
                            ->where('so.date','<=', $date_end)
                            ->orderBy('so.branch_id')
                            ->orderBy('so.date')
                            ->get();

        $this->services_count = count($sol_service);

        $package_claims = DB::table('client_claims as cc')
                            ->select('cc.id')
                            ->addSelect('cc.category_id')
                            ->addSelect('cc.parent_id')
                            ->addSelect('so.so_number')
                            ->addSelect('c.last_name')
                            ->addSelect('c.first_name')
                            ->addSelect('s.name as service_name')
                            ->addSelect('p.name as package_name')
                            ->addSelect('cc.claimed_by_date')
                            ->addSelect('so.or_number')
                            ->addSelect('so.cif_number')
                            ->addSelect(DB::raw('CONCAT(e.last_name, ", ", e.first_name) as assistant '))
                            ->addSelect('so.notes')
                            ->addSelect('b.name as branch_name')
                            ->join('sales_orders as so','so.id','=','cc.parent_id')
                            ->join('services as s','s.id','=','cc.sellable_id')
                            ->join('packages as p','p.id','=','cc.category_id')
                            ->join('clients as c','c.id','=','cc.claimed_by_id')
                            ->leftJoin('employees as e','e.id','cc.assisted_by_id')
                            ->join('branches as b','b.id','=','cc.branch_id')
                            ->where('category_type','App\\Package')
                            ->where('cc.treated_by_id', $doc_id)
                            ->where('cc.claimed_by_date','>=', $date_start)
                            ->where('cc.claimed_by_date','<=', $date_end)
                            ->orderBy('cc.branch_id')
                            ->orderBy('cc.claimed_by_date')
                            ->get();

        $this->packages_count = count($package_claims);

        $package_price_array = [];

        foreach($package_claims as $x)
        {
            $package_price_array[$x->id] = SalesOrderLine::where('sellable_type','App\\Package')
                ->where('sales_order_id',$x->parent_id)
                ->where('sellable_id',$x->category_id)
                ->first()
                ->price;
        }

        $packages = Package::all();
        $divisor_array = [];
        foreach($packages as $x)
        {
            $divisor_array[$x->id] = $x->divisor();
        }


        $membership_claims = DB::table('client_claims as cc')
                            ->select('cc.id')
                            ->addSelect('cc.category_id')
                            ->addSelect('cc.parent_id')
                            ->addSelect('so.so_number')
                            ->addSelect('c.last_name')
                            ->addSelect('c.first_name')
                            ->addSelect('s.name as service_name')
                            ->addSelect('m.name as membership_name')
                            ->addSelect('cc.claimed_by_date')
                            ->addSelect('so.or_number')
                            ->addSelect('so.cif_number')
                            ->addSelect(DB::raw('CONCAT(e.last_name, ", ", e.first_name) as assistant '))
                            ->addSelect('so.notes')
                            ->addSelect('b.name as branch_name')
                            ->join('sales_orders as so','so.id','=','cc.parent_id')
                            ->join('services as s','s.id','=','cc.sellable_id')
                            ->join('memberships as m','m.id','=','cc.category_id')
                            ->join('clients as c','c.id','=','cc.claimed_by_id')
                            ->leftJoin('employees as e','e.id','cc.assisted_by_id')
                            ->join('branches as b','b.id','=','cc.branch_id')
                            ->where('category_type','App\\Membership')
                            ->where('cc.treated_by_id', $doc_id)
                            ->where('cc.claimed_by_date','>=', $date_start)
                            ->where('cc.claimed_by_date','<=', $date_end)
                            ->orderBy('cc.branch_id')
                            ->orderBy('cc.claimed_by_date')
                            ->get();

        $this->memberships_count = count($membership_claims);

        $sold_products = DB::table('sales_order_lines as sol')
                            ->select('so.so_number')
                            ->addSelect('c.last_name')
                            ->addSelect('c.first_name')
                            ->addSelect('p.name')
                            ->addSelect('so.date')
                            ->addSelect('so.si_number')
                            ->addSelect('sol.price')
                            ->addSelect('so.notes')
                            ->addSelect('b.name as branch_name')
                            ->join('sales_orders as so','so.id','=','sol.sales_order_id')
                            ->join('products as p','p.id','=','sol.sellable_id')
                            ->join('clients as c','c.id','=','so.client_id')
                            ->join('branches as b','b.id','=','so.branch_id')
                            ->where('sellable_type','App\\Product')
                            ->where('sol.sold_by_id', $doc_id)
                            ->where('so.date','>=', $date_start)
                            ->where('so.date','<=', $date_end)
                            ->orderBy('so.branch_id')
                            ->orderBy('so.date')
                            ->get();

        $this->sold_products_count = count($sold_products);

        $sold_services = DB::table('sales_order_lines as sol')
                            ->select('so.so_number')
                            ->addSelect('c.last_name')
                            ->addSelect('c.first_name')
                            ->addSelect('s.name')
                            ->addSelect('so.date')
                            ->addSelect('so.or_number')
                            ->addSelect('so.cif_number')
                            ->addSelect('sol.price')
                            ->addSelect('so.notes')
                            ->addSelect('b.name as branch_name')
                            ->join('sales_orders as so','so.id','=','sol.sales_order_id')
                            ->join('services as s','s.id','=','sol.sellable_id')
                            ->join('clients as c','c.id','=','so.client_id')
                            ->join('branches as b','b.id','=','so.branch_id')
                            ->where('sellable_type','App\\Service')
                            ->where('sol.sold_by_id', $doc_id)
                            ->where('so.date','>=', $date_start)
                            ->where('so.date','<=', $date_end)
                            ->orderBy('so.branch_id')
                            ->orderBy('so.date')
                            ->get();

        $this->sold_services_count = count($sold_services);

        $sold_packages = DB::table('sales_order_lines as sol')
                            ->select('so.so_number')
                            ->addSelect('c.last_name')
                            ->addSelect('c.first_name')
                            ->addSelect('p.name')
                            ->addSelect('so.date')
                            ->addSelect('so.or_number')
                            ->addSelect('so.cif_number')
                            ->addSelect('sol.price')
                            ->addSelect('so.notes')
                            ->addSelect('b.name as branch_name')
                            ->join('sales_orders as so','so.id','=','sol.sales_order_id')
                            ->join('packages as p','p.id','=','sol.sellable_id')
                            ->join('clients as c','c.id','=','so.client_id')
                            ->join('branches as b','b.id','=','so.branch_id')
                            ->where('sellable_type','App\\Package')
                            ->where('sol.sold_by_id', $doc_id)
                            ->where('so.date','>=', $date_start)
                            ->where('so.date','<=', $date_end)
                            ->orderBy('so.branch_id')
                            ->orderBy('so.date')
                            ->get();

        $this->sold_packages_count = count($sold_packages);

        $sold_memberships = DB::table('sales_order_lines as sol')
                            ->select('so.so_number')
                            ->addSelect('c.last_name')
                            ->addSelect('c.first_name')
                            ->addSelect('m.name')
                            ->addSelect('so.date')
                            ->addSelect('so.or_number')
                            ->addSelect('so.cif_number')
                            ->addSelect('sol.price')
                            ->addSelect('so.notes')
                            ->addSelect('b.name as branch_name')
                            ->join('sales_orders as so','so.id','=','sol.sales_order_id')
                            ->join('memberships as m','m.id','=','sol.sellable_id')
                            ->join('clients as c','c.id','=','so.client_id')
                            ->join('branches as b','b.id','=','so.branch_id')
                            ->where('sellable_type','App\\Membership')
                            ->where('sol.sold_by_id', $doc_id)
                            ->where('so.date','>=', $date_start)
                            ->where('so.date','<=', $date_end)
                            ->orderBy('so.branch_id')
                            ->orderBy('so.date')
                            ->get();

        $this->sold_memberships_count = count($sold_memberships);

        return view('excels.doctors', compact('doc_name','sol_service','date_start','date_end','package_claims','package_price_array','divisor_array','membership_claims','sold_products','sold_services','sold_packages','sold_memberships'));
    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class  => function(BeforeExport $event) {
                $event->writer->setCreator('Skin Pro RS');
            },
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                //Headers
                $letters = ['A','B'];
                $num = [1,2,3];

                foreach($letters as $x)
                {
                    foreach($num as $y)
                    {
                        $event->sheet->styleCells(
                            $x . $y,
                            [
                                'borders' => [
                                    'outline' => [
                                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                        'color' => ['argb' => 'FF000000'],
                                    ],
                                ]
                            ]
                        );
                    }
                }

                //Treatments - Services
                $event->sheet->styleCells(
                    'A5:J5',
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

                $letters = ['A','B','C','D','E','F','G','H','I','J'];
                $num = [6];

                for($i = 1; $i <= $this->services_count ; $i ++)
                {
                    array_push($num, $i + $num[0]);
                }

                foreach($letters as $x)
                {
                    foreach($num as $y)
                    {
                        $event->sheet->styleCells(
                            $x . $y,
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
                    }
                }

                //Treatments - Packages
                $previous = array_pop($num) + 3;
                $event->sheet->styleCells(
                    'A' . $previous . ':J' . $previous,
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

                $letters = ['A','B','C','D','E','F','G','H','I','J'];
                $num = [$previous + 1];

                for($i = 1; $i <= $this->packages_count + $this->memberships_count ; $i ++)
                {
                    array_push($num, $i + $num[0]);
                }

                foreach($letters as $x)
                {
                    foreach($num as $y)
                    {
                        $event->sheet->styleCells(
                            $x . $y,
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
                    }
                }

                //Sold - Products
                $previous = array_pop($num) + 3;
                $event->sheet->styleCells(
                    'A' . $previous . ':H' . $previous,
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

                $letters = ['A','B','C','D','E','F','G','H'];
                $num = [$previous + 1];

                for($i = 1; $i <= $this->sold_products_count ; $i ++)
                {
                    array_push($num, $i + $num[0]);
                }

                foreach($letters as $x)
                {
                    foreach($num as $y)
                    {
                        $event->sheet->styleCells(
                            $x . $y,
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
                    }
                }

                //Sold - Services
                $previous = array_pop($num) + 3;
                $event->sheet->styleCells(
                    'A' . $previous . ':H' . $previous,
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

                $letters = ['A','B','C','D','E','F','G','H'];
                $num = [$previous + 1];

                for($i = 1; $i <= $this->sold_services_count ; $i ++)
                {
                    array_push($num, $i + $num[0]);
                }

                foreach($letters as $x)
                {
                    foreach($num as $y)
                    {
                        $event->sheet->styleCells(
                            $x . $y,
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
                    }
                }

                //Sold - Packages
                $previous = array_pop($num) + 3;
                $event->sheet->styleCells(
                    'A' . $previous . ':H' . $previous,
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

                $letters = ['A','B','C','D','E','F','G','H'];
                $num = [$previous + 1];

                for($i = 1; $i <= $this->sold_packages_count + $this->sold_memberships_count; $i ++)
                {
                    array_push($num, $i + $num[0]);
                }

                foreach($letters as $x)
                {
                    foreach($num as $y)
                    {
                        $event->sheet->styleCells(
                            $x . $y,
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
                    }
                }
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
