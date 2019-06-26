<?php

namespace App\Http\Controllers;

use App\Client;
use App\Payment;
use App\History;
use App\Sequence;
use App\PaymentType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $index_url = "/payments";
        $api_url = "/api/payments";
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
                'name' => 'doc_reference',
                'sortField' => 'py_number',
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
                'name' => 'amount',
                'title' => 'Amount',
                'sortField' => 'amount',
                'titleClass' => 'text-center',
                'dataClass' => 'text-center',
            ],

            [
                'name' => 'p_type',
                'sortField' => 'payment_type_id',
                'title' => 'Payment Type',
                'titleClass' => 'text-center',
                'dataClass' => 'text-center',
            ],
        ]);

        return view('payments.index', compact('index_url', 'api_url', 'per_page', 'fields'));

    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function create(Client $client)
    {
        $payment_types = PaymentType::where('is_direct', 1)->get();

        $min_date = Sequence::where('name','Date Lock End')->first()->text_value;

        return view('payments.create', compact('client', 'payment_types','min_date'));
    }

    public function store(Request $request)
    {
    	DB::transaction(function () use ($request) {

            $py_number = Sequence::where('name','PY Number')->firstOrFail();
            $current_py_number = $py_number->text_value;
            $py_number->integer_value++;
            $py_number->decimal_value++;
            $py_number->text_value = $py_number->integer_value;

            $py_number->save();

            $payment = Payment::create([
               'date' => $request->date,
               'parent_type' => 'App\\Client',
               'parent_id' => $request->client_id,
               'amount' => $request->amount,
               'reference' => $request->reference,
               'notes' => $request->notes,
               'payment_type_id' => $request->payment_type_id,
               'branch_id' => $request->branch_id,
               'py_number' => $current_py_number,
               'receptionist_id' => $request->receptionist_id,
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

    public function destroy(Payment $payment, Request $request)
    {
        DB::transaction(function () use ($payment, $request) {
            $payment->delete();

            History::where([
               'client_id' => $request->client_id,
               'parent_type' => 'App\\Payment',
               'parent_id' => $payment->id,
           ])->delete();

        });


        return redirect('/clients/' . $request->client_id)->with(['message' => 'Payment Deleted', 'message_type' => 'danger']);
    }

}
