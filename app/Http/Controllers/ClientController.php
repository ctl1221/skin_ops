<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientClaim;
use App\Employee;
use App\Pricelist;
use App\ClientMembership;
use App\SalesOrder;
use App\History;
use App\Sequence;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index()
    {
        $index_url = "clients";
        $api_url = "/api/clients";
        $per_page = 10;

        $fields = json_encode([
        [
            'name' => 'fullname',
            'sortField' => 'last_name',
            'title' => 'Name',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
        ],

                [
            'name' => 'pricelist_name',
            'sortField' => 'pricelist_id',
            'title' => 'Member',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
        ],

        [
            'name' => 'is_active',
            'sortField' => 'is_active',
            'title' => 'Status',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'callback' => 'badgify',
        ],
        
        // [
        //     'name' => 'id',
        //     'title' => 'Details',
        //     'titleClass' => 'text-center',
        //     'dataClass' => 'text-center',
        //     'callback' => 'linkify',
        // ],
    ]);

        return view('clients.index', compact('index_url', 'api_url', 'per_page', 'fields'));
    }

    public function create()
    {
        $pricelists = Pricelist::all();

        return view('clients.create', compact('pricelists'));
    }

    public function store(Request $request)
    {
        $client = Client::create([
                'last_name' => $request->last_name, 
                'first_name' => $request->first_name,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'pricelist_id' => $request->pricelist_id ? 1 : 1,
                'email' => $request->email,
                'address' => $request->address,
                'mobile_number' => $request->mobile_no,
                'opt_out' => $request->opt_out ? 1 : 0,
            ]);

        return redirect('/clients/' . $client->id); 
    }

    public function show(Client $client)
    {
        $client = Client::with('histories','sales_orders','sales_order_lines','payment_histories')->find($client->id);

        $histories = History::with('parent')->where('client_id',$client->id)->orderBy('date','desc')->orderBy('id','desc')->get();

        $payments = History::with('parent')->where('client_id',$client->id)
                    ->whereIn('parent_type',['App\\SalesOrder','App\\Payment'])
                    ->orderBy('date','asc')->get();

        $sales_order_ids = $client->sales_orders->pluck('id');

        $claims = ClientClaim::with('branch','category','sellable','parent','claimed_by')
            ->where('parent_type','App\\SalesOrder')
            ->whereIn('parent_id', $sales_order_ids)
            ->get();

        $colors = Sequence::colors();

        return view('clients.show', compact('client','histories','payments','claims','colors'));
    }

    public function edit(Client $client)
    {
        $pricelists = Pricelist::all();

        return view('clients.edit', compact('client', 'pricelists'));
    }

    public function update(Request $request, Client $client)
    {
        $client->last_name = $request->last_name;
        $client->first_name = $request->first_name;
        $client->birthday = $request->birthday;
        $client->gender = $request->gender;
        $client->email = $request->email;
        $client->address = $request->address;
        $client->mobile_number = $client->mobile_no;
        $client->opt_out = $request->opt_out ? 1 : 0;

        if($request->pricelist_id)
        {
            $client->pricelist_id = $request->pricelist_id;
        }

        $client->save();
        
        return redirect('/clients/' . $client->id);
    }

    public function search()
    {
        return view('clients.search');
    }

    public function claim(Client $client)
    {
        $treated_by = Employee::where('is_active', 1)
            ->where('is_aesthetician', 1)
            ->orWhere('is_doctor', 1)
            ->orderBy('last_name', 'asc')
            ->get();

        $assisted_by = Employee::where('is_active', 1)
            ->where('is_aesthetician', 1)
            ->orderBy('last_name', 'asc')
            ->get();

        $min_date = Sequence::where('name','Date Lock End')->first()->text_value;

        return view('clients.claim', compact('client', 'treated_by', 'assisted_by','min_date'));
    }

    public function claimPost(Client $client, Request $request)
    {
        DB::transaction(function () use ($request, $client) {

            $client_claim = ClientClaim::findOrFail($request->selected_client_claim_id);

            History::create([
                'client_id' => $client->id,
                'date' => $request->claimed_by_date,
                'parent_type' => 'App\\ClientClaim',
                'parent_id' => $client_claim->id,
            ]);

            if($request->selected_give_others_id && !$request->has('claim_for_myself'))
            {
                $claimer_id  = $request->selected_give_others_id;

                History::create([
                    'client_id' => $claimer_id,
                    'date' => $request->claimed_by_date,
                    'parent_type' => 'App\\ClientClaim',
                    'parent_id' => $client_claim->id,
                ]);
            }
            else
            {
                $claimer_id = $client->id;
            }
            
            $client_claim->claimed_by_id = $claimer_id;
            $client_claim->branch_id =  $request->branch_id;
            $client_claim->treated_by_id = $request->treated_by_id;
            $client_claim->assisted_by_id = $request->assisted_by_id;
            $client_claim->claimed_by_date = $request->claimed_by_date;
            $client_claim->notes = $request->notes;
            $client_claim->save();
        });

        return redirect('/clients/' . $client->id )->with(['message' => 'Claimed Package', 'message_type' => 'success']);;
    }

     public function deactivate(Client $client)
    {
        $client->is_active = 0;
        $client->save();

        return back();
    }

    public function activate(Client $client)
    {
        $client->is_active = 1;
        $client->save();

        return back();
    }
}
