<?php

namespace App\Http\Controllers;

use App\PaymentType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $payment_types = PaymentType::all();

        return view('payment_types.index', compact('payment_types'));
    }

    public function create()
    {
        return view('payment_types.create');
    }

    public function store(Request $request)
    {
        PaymentType::create([
                'name' => $request->name, 
                ]);

        return redirect('/payment_types'); 
    }

    public function show(PaymentType $paymentType)
    {
        
    }

    public function edit(PaymentType $payment_type)
    {

        return view('payment_types.edit', compact('payment_type'));

    }

    public function update(Request $request, PaymentType $payment_type)
    {

        $payment_type->name = $request->name;
        $payment_type->is_direct = $request->is_direct ? 1 : 0;
        $payment_type->is_external = $request->is_external ? 1 : 0;
        $payment_type->is_addable = $request->is_addable ? 1 : 0;
        $payment_type->is_subtractable = $request->is_subtractable ? 1 : 0;

        $payment_type->save();
            
        return back()->with(['message' => 'Payment Type Updated', 'message_type' => 'info']);
    }

    public function deactivate(PaymentType $paymentType)
    {
        $paymentType->is_active = 0;
        $paymentType->save();

        return back();
    }

    public function activate(PaymentType $paymentType)
    {
        $paymentType->is_active = 1;
        $paymentType->save();

        return back();
    }
}
