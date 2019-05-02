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

    public function edit()
    {
        $payment_types = PaymentType::all();

        return view('payment_types.edit', compact('payment_types'));
    }

    public function update(Request $request)
    {
        $payment_types = PaymentType::all();

        DB::transaction(function () use ($request, $payment_types) {
            foreach ($payment_types as $x)
            {
                PaymentType::where('id', $x->id)
                            ->update([
                                'name' => $request[$x->id],
                            ]);
            }
        });
            
        return redirect ('/payment_types');
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
