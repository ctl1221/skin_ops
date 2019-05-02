<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesOrder;
use App\SalesOrderLine;
use App\Sellable;
use App\PricelistSellable;
use App\Client;
use App\PaymentType;

use Illuminate\Support\Facades\DB;

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

      $payment_types = PaymentType::where('is_active', '=' , 1)->get();

  		return view('sales_orders.create', compact('sellables', 'client', 'payment_types'));
  	}

    public function store(Request $request)
    {
      
      $client = Client::find($request->client_id);
      $sales_order_lines = json_decode($request->sales_order_lines);

      DB::transaction(function () use ($request, $sales_order_lines) {
            $sales_order = SalesOrder::create([
                'so_number' => '0050',
            ]);

            foreach($sales_order_lines as $x)
            {
              SalesOrderLine::create([
                  'sales_order_id' => $sales_order->id,
                  'sellable_type' => $x->sellable_type,
                  'sellable_id' => $x->sellable_id,
                  'price' => $x->price,
              ]); 
            }
        });

        return redirect('/clients/' . $client->id);
    }

    public function destroy(SalesOrder $sales_order)
    {
        $sales_order->delete();
        
        return redirect('/sales_orders');
    }
}
