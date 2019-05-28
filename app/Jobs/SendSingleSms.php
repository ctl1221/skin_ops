<?php

namespace App\Jobs;

use App\SMSEagle;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSingleSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sms, $mobile_no, $details;

    public function __construct($mobile_no, $details)
    {
        $this->mobile_no = $mobile_no;
        $this->details = $details;
    }

    public function handle()
    {
        $sms = new SMSEagle();
        $sms->to = $this->mobile_no;
        $sms->sendSMS($this->details);
    }
}
