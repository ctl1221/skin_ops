<?php

namespace App\Http\Controllers;

use App\Client;
use App\Payment;
use App\History;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Client $client)
    {
    	return view('payments.create', compact('client'));
    }

    public function store(Request $request)
    {
    	DB::transaction(function () use ($request) {
	    	$payment = Payment::create([
	            'date' => $request->date,
	            'parent_type' => 'App\\Client',
	            'parent_id' => $request->client_id,
	            'amount' => $request->amount,
	            'reference' => $request->reference,
	            'payment_type_id' => 3,
	         ]); 

	        History::create([
	            'client_id' => $request->client_id,
	            'date' => $request->date,
	            'parent_type' => 'App\\Payment',
	            'parent_id' => $payment->id,
	        ]);
        });

    	return redirect('/clients/' . $request->client_id)->with(['message' => 'Payment Created', 'message_type' => 'success']);
    }

}
