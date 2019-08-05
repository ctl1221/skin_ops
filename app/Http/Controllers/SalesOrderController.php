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
            'dataClass' => 'text-center',
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
            'title' => 'Client',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
        ],

        [
            'name' => 'totalprice',
            'title' => 'Total Price',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'callback' => 'currency',
        ],

        [
            'name' => 'payableamount',
            'title' => 'Payable Amount',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'callback' => 'currency',
        ],
    ]);

      return view('sales_orders.index', compact('index_url', 'api_url', 'per_page', 'fields'));
    }

  public function create(Client $client)
  {
    $sellables = PricelistSellable::where('pricelist_id',$client->pricelist_id)
                ->with('sellable')
                ->get();

    //For Alphabetizing
    $o_service_ids = \App\Service::orderBy('name')->pluck('id');
    $o_product_ids = \App\Product::orderBy('name')->pluck('id');
    $o_package_ids = \App\Package::orderBy('name')->pluck('id');
    $o_membership_ids = \App\Membership::orderBy('name')->pluck('id');
    $ordered_ids['App\\Service'] = $o_service_ids;
    $ordered_ids['App\\Product'] = $o_product_ids;
    $ordered_ids['App\\Package'] = $o_package_ids;
    $ordered_ids['App\\Membership'] = $o_membership_ids;

    $ordered_ids = json_encode($ordered_ids);

    $employees = Employee::where('is_active',1)->orderBy('last_name','asc')->get();

    $payment_types = PaymentType::where('is_active', '=' , 1)->get();

    $min_date = Sequence::where('name','Date Lock End')->first()->text_value;

    return view('sales_orders.create', compact('sellables', 'client', 'payment_types','employees','min_date','ordered_ids'));

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
        'branch_id' => $request->branch_id,
        'receptionist_id' => $request->receptionist_id,
        'notes' => $request->notes,
        'or_number' => $request->or_number ? $request->or_number : null,
        'cif_number' => $request->cif_number ? $request->cif_number : null,
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
            'branch_id' => $request->branch_id,
            'receptionist_id' => $request->receptionist_id,
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

  public function edit(SalesOrder $sales_order)
  {
    return view('sales_orders.edit', compact('sales_order'));
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
                      'category_type' => 'App\\Membership',
                      'category_id' => $x->sellable_id,
                    ]);
                  }
                }
              }
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

  public function update(SalesOrder $sales_order, Request $request)
  {
    $sales_order->date = $request->date;
    $sales_order->or_number = $request->or_number;
    $sales_order->cif_number = $request->cif_number;
    $sales_order->save();
    
    return redirect('/sales_orders/' . $sales_order->id);
  }

  public function destroy(SalesOrder $sales_order)
  {
      DB::transaction(function () use ($sales_order) {
          $sales_order->delete();

          foreach($sales_order->payments as $x)
          {
            $x->delete();
          }
      });
    
    return redirect('/sales_orders');
  }

  public function delete(SalesOrder $sales_order)
  {
      $client_id = $sales_order->client_id;

      DB::transaction(function () use ($sales_order) {
        foreach($sales_order->sales_order_lines as $x)
        {
          if($x->sellable_type == 'App\\Membership')
          {
            $membership = ClientMembership::where('client_id', $sales_order->client->id)
                            ->where('membership_id', $x->sellable_id)
                            ->where('date_start', $sales_order->date)
                            ->first();

            if($membership->is_expired == 0)
            {
              $client = Client::findOrFail($membership->client_id);
              $client->pricelist_id = 1;
              $client->save();
            }

            $membership->delete();
          }      
        }

        $claim_ids = ClientClaim::where('parent_type', 'App\SalesOrder')
                   ->where('parent_id', $sales_order->id)
                   ->pluck('id');

        ClientClaim::where('parent_type', 'App\SalesOrder')
                   ->where('parent_id', $sales_order->id)
                   ->delete();

        History::where('parent_type', 'App\SalesOrder')
                   ->where('parent_id', $sales_order->id)
                   ->delete();

        History::where('parent_type', 'App\ClientClaim')
           ->whereIn('parent_id', $claim_ids)
           ->delete();

        Payment::where('parent_type', 'App\SalesOrder')
                   ->where('parent_id', $sales_order->id)
                   ->delete();

        $sales_order->delete();

      });

    return redirect('/clients/' . $client_id )->with(['message' => 'Sales Order Deleted', 'message_type' => 'error']);;
  
  }

}
