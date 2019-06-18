<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendSingleSms;
use App\SMSEagle;
use App\SMSPromotion;

class SMSPromotionController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $sms_promotions = SMSPromotion::all();

        return view('sms_promotions.index', compact('sms_promotions'));
    }

    public function create()
    {
    	return view('sms_promotions.create');
    }

    public function store(Request $request)
    {
        SendSingleSms::dispatch($mobile_no = $request->mobile_no, $details = $request->details);
      
		return back();
    }
}
