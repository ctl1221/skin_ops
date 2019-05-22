<?php

namespace App;
use GuzzleHttp;

class SMSEagle
{
    public $url, $login, $pass, $to, $groupname, $flash;

    public function __construct()
    {
    	$this->url = env('SMSEAGLE_URL');
    	$this->login = env('SMSEAGLE_LOGIN');
    	$this->pass = env('SMSEAGLE_PASS');
    	$this->to = env('SMSEAGLE_TO');
    	$this->groupname = env('SMSEAGLE_GROUP');
        $this->flash = 0;
    }

    public function sendSMS($message)
    {
    	$client = new GuzzleHttp\Client();

    	$response = $client->get($this->url . 'send_sms' , [
          'query' => [
            'login' => $this->login,
            'pass' => $this->pass,
            'to' => $this->to,
            'message' => $message,
            'flash' => $this->flash,
            ]
        ]);

        return $response;
    }

    public function sendSMSGroup($message)
    {
    	$client = new GuzzleHttp\Client();

    	$response = $client->get($this->url . 'send_togroup', [
          'query' => [
            'login' => $this->login,
            'pass' => $this->pass,
            'groupname' => $this->groupname,
            'message' => $message]
        ]);

        return $response;
    }

}
