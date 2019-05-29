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
use App\Sequence;

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
        $index_url = "/sales_orders";
        $api_url = "/api/sales_orders";
        $per_page = 10;

        $fields = json_encode([
        [
            'name' => 'date',
            'sortField' => 'date',
            'title' => 'Date',
            'titleClass' => 'text-center',
            'dataClass' => 'text-left',
        ],

        [
            'name' => 'reference',
            'sortField' => 'so_number',
            'title' => 'Reference',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
        ],

        [
            'name' => 'fullname',
            'sortField' => 'last_name',
            'title' => 'Client',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
        ],

        [
            'name' => 'totalprice',
            'sortField' => 'totalprice',
            'title' => 'Total Price',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
        ],

        [
            'name' => 'payableamount',
            'sortField' => 'payableamount',
            'title' => 'Payable Amount',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
        ],

        [
            'name' => 'id',
            'title' => 'View',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'callback' => 'linkify',
        ],
    ]);

      return view('sales_orders.index', compact('index_url', 'api_url', 'per_page', 'fields'));
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

      $so_number = Sequence::where('name','DT Number')->firstOrFail();
      $current_so_number = $so_number->text_value;
      $so_number->integer_value++;
      $so_number->decimal_value++;
      $so_number->text_value = $so_number->integer_value;

      $so_number->save();

      $sales_order = SalesOrder::create([
        'client_id' => $client->id,
        'so_number' => $current_so_number,
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

      return $sales_order->id;
    });

    return redirect('/sales_orders/' . $latest_id)->with(['message' => 'Draft Job Created', 'message_type' => 'info']);
  }

  public function show(SalesOrder $sales_order)
  {
    return view('sales_orders.show', compact('sales_order'));
  }

  public function post(SalesOrder $sales_order)
  {

    if(! $sales_order->is_posted )
    {
      DB::transaction(function () use ($sales_order) {

        foreach($sales_order->sales_order_lines as $x)
        {
          if($x->sellable_type =='App\\Membership')
          {

            $membership = Membership::findOrFail($x->sellable_id);

            ClientMembership::create([
              'client_id' => $sales_order->client->id,
              'membership_id' => $x->sellable_id,
              'date_start' => $sales_order->date,
              'date_end' => Carbon::parse($sales_order->date)->addDays($membership->days_valid),
            ]);
          }

          if($x->sellable_type == 'App\\Package')
          {
            foreach($x->sellable->breakdowns as $y)
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

        History::create([
            'client_id' => $sales_order->client->id,
            'date' => $sales_order->date,
            'parent_type' => 'App\\SalesOrder',
            'parent_id' => $sales_order->id,
          ]);

        $so_number = Sequence::where('name','SO Number')->firstOrFail();
        $current_so_number = $so_number->text_value;
        $so_number->integer_value++;
        $so_number->decimal_value++;
        $so_number->text_value = $so_number->integer_value;
        
        $so_number->save(); 

        $sales_order->is_posted = 1;
        $sales_order->so_number = $current_so_number;
        $sales_order->save();
      });
    }

    return back()->with(['message' => 'Sales Order Posted', 'message_type' => 'success']);;
  }

  public function destroy(SalesOrder $sales_order)
  {
    $sales_order->delete();

    return redirect('/sales_orders');
  }
}
