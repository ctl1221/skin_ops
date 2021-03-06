<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendSingleSms;

use App\SMSEagle;
use App\SMSPromotion;
use App\Client;

class SMSPromotionController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $sms_promotions = SMSPromotion::all();

        $client_numbers_available = Client::whereRaw('LENGTH(mobile_number) = 12')->count();
        $no_number_clients = Client::whereNull('mobile_number')->count();
        $total_clients = Client::all()->count();

        $client_w_wrong_no = Client::whereRaw('LENGTH(mobile_number) <> 12')->orderBy('last_name')->get();

        return view('sms_promotions.index', compact('sms_promotions','client_numbers_available','total_clients','no_number_clients', 'client_w_wrong_no'));
    }

    public function create()
    {
    	return view('sms_promotions.create');
    }

    public function store(Request $request)
    {
        if($request->sms_type == 'Single' && $request->mobile_no)
        {
            $content = str_replace('%Name%', \Auth::user()->name, $request->details);

            SendSingleSms::dispatch($mobile_no = $request->mobile_no, $details = $content);
        }

        elseif($request->sms_type == 'Opt')
        {
            $clients = Client::where('opt_out',0)->get();

            foreach($clients as $client)
            {
                if($client->mobile_number)
                {
                    $content = str_replace('%Name%', $client->first_name, $request->details);
                    SendSingleSms::dispatch($mobile_no = $client->mobile_number, $details = $content);
                }
                
            }

        }
        
        else
        {
            $clients = Client::all();
            foreach($clients as $client)
            {
                if($client->mobile_number)
                {
                    $content = str_replace('%Name%', $client->first_name, $request->details);
                    SendSingleSms::dispatch($mobile_no = $client->mobile_number, $details = $content);
                }
            }
        }

        SMSPromotion::create([
            'details' => $request->details,
            'type' => $request->sms_type,
        ]);
        
		return redirect('/sms_promotions');
    }
}
