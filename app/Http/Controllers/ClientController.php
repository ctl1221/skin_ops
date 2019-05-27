<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientClaim;
use App\Pricelist;
use App\ClientMembership;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index()
    {
        $clients = Client::orderBy('last_name','asc')->paginate('8');

        return view ('clients.index', compact('clients'));
    }

    public function create()
    {
        $pricelists = Pricelist::all();

        return view('clients.create', compact('pricelists'));
    }

    public function store(Request $request)
    {
        $clients = Client::all();

        Client::create([
                'last_name' => $request->last_name, 
                'first_name' => $request->first_name,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'pricelist_id' => $request->pricelist_id,
                'email' => $request->email,
                'address' => $request->address,
                'mobile_number' => $request->mobile_no,
                ]);

        return redirect('/clients'); 
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        $pricelists = Pricelist::all();

        return view('clients.edit', compact('client', 'pricelists'));
    }

    public function update(Request $request, Client $client)
    {
        Client::where('id', $client->id)
                            ->update([
                                'last_name' => $request->last_name, 
                                'first_name' => $request->first_name,
                                'birthday' => $request->birthday,
                                'gender' => $request->gender,
                                'pricelist_id' => $request->pricelist_id,
                                'email' => $request->email,
                                'address' => $request->address,
                                'mobile_number' => $request->mobile_no,
                            ]);

        return redirect('/clients/' . $client->id);
    }

    public function search()
    {
        return view('clients.search');
    }

    public function claim(Client $client)
    {
        return view('clients.claim', compact('client'));
    }

    public function claimPost(Client $client, Request $request)
    {
        $client_claim = ClientClaim::findOrFail($request->selected_client_claim_id);

        if($request->selected_give_others_id && !$request->has('claim_for_myself'))
            $client_claim->claimed_by_id = $request->selected_give_others_id;
        else
            $client_claim->claimed_by_id = $client->id;
        $client_claim->save();

        return redirect('/clients/' . $client->id );
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
