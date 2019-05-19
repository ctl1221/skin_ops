<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SMSEagle;

class SMSPromotionController extends Controller
{
    public function create()
    {
    	$sms = new SMSEagle();
    	$sms->to = "09175794288";
	    $sms->sendSMS("hehhe\nHello");

		return 'Success';
    }
}
