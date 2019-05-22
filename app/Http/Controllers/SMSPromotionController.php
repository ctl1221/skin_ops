<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendSingleSms;
use App\SMSEagle;

class SMSPromotionController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
    	return view('sms_promotions.create');
    }

    public function store(Request $request)
    {
        dispatch(new SendSingleSms($mobile_no = $request->mobile_no, $details = $request->details));
      
		return back();
    }
}
