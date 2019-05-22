<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesOrder;
use App\SalesOrderLine;
use App\Sellable;
use App\PricelistSellable;
use App\Client;
use App\PaymentType;
use App\Payment;
use App\History;
use App\ClientClaim;
use App\ClientMembership;
use App\Membership;
use App\Employee;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
  	{
  
  	}

  	public function create(Client $client)
  	{

  		$sellables = PricelistSellable::where('pricelist_id',$client->pricelist_id)
            ->with('sellable')
            ->get();

      $employees = Employee::where('is_active',1)->orderBy('last_name','asc')->get();

      $payment_types = PaymentType::where('is_active', '=' , 1)->get();

  		return view('sales_orders.create', compact('sellables', 'client', 'payment_types','employees'));

  	}

    public function store(Request $request)
    {
      
      $client = Client::findOrFail($request->client_id);
      $sales_order_lines = json_decode($request->sales_order_lines);
      $payment_lines = json_decode($request->payment_lines);

      $latest_id = DB::transaction(function () use ($request, $sales_order_lines, $client, $payment_lines) {
            $sales_order = SalesOrder::create([
                'client_id' => $client->id,
                'so_number' => '0050',
                'date' => $request->date,
                'notes' => $request->notes,
            ]);

            foreach($sales_order_lines as $x)
            {
              $sales_order_line = SalesOrderLine::create([
                  'sales_order_id' => $sales_order->id,
                  'sellable_type' => $x->sellable_type,
                  'sellable_id' => $x->sellable_id,
                  'price' => $x->price,
                  'sold_by_id' => intval($x->sold_by_id),
                  'treated_by_id' => intval($x->treated_by_id),
                  'assisted_by_id' => intval($x->assisted_by_id),
              ]); 

              if($x->sellable_type =='App\\Membership')
              {
                $membership = Membership::findOrFail($x->sellable_id);

                ClientMembership::create([
                    'client_id' => $client->id,
                    'membership_id' => $x->sellable_id,
                    'date_start' => $request->date,
                    'date_end' => Carbon::parse($request->date)->addDays($membership->days_valid),
                ]);
              }

              if($x->sellable_type == 'App\\Package')
              {
                foreach($sales_order_line->sellable->breakdowns as $y)
                {
                  if($y->sellable_type == 'App\\Service')
                  {
                    for($i = 0; $i < $y->quantity; $i++)
                    {
                      ClientClaim::create([
                          'parent_type' => 'App\\SalesOrder',
                          'parent_id' => $sales_order->id,
                          'sellable_type' => $y->sellable_type,
                          'sellable_id' => $y->sellable_id,
                          'category_type' => 'App\\Package',
                          'category_id' => $x->sellable_id,
                      ]);
                    }
                  }
                }
              }         
            }

            foreach($payment_lines as $x)
            {
              if($x->checked)
              {
                Payment::create([
                    'date' => $request->date,
                    'parent_type' => 'App\\SalesOrder',
                    'parent_id' => $sales_order->id,
                    'amount' => $x->amount,
                    'reference' => $x->reference,
                    'payment_type_id' => $x->id,
                ]); 
              }
            }

          History::create([
                  'client_id' => $client->id,
                  'date' => $request->date,
                  'parent_type' => 'App\\SalesOrder',
                  'parent_id' => $sales_order->id,
          ]);
          
          return $sales_order->id;
        });

      return redirect('/sales_orders/' . $latest_id);
    }

     public function show(SalesOrder $sales_order)
    {
        return view('sales_orders.show', compact('sales_order'));
    }

    public function destroy(SalesOrder $sales_order)
    {
        $sales_order->delete();
        
        return redirect('/sales_orders');
    }
}
