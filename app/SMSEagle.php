<?php

namespace App;
use GuzzleHttp;

class SMSEagle
{
    public $url, $login, $pass, $to, $groupname;

    public function __construct()
    {
    	$this->url = env('SMSEAGLE_URL');
    	$this->login = env('SMSEAGLE_LOGIN');
    	$this->pass = env('SMSEAGLE_PASS');
    	$this->to = env('SMSEAGLE_TO');
    	$this->groupname = env('SMSEAGLE_GROUP');
    }

    public function sendSMS($message)
    {
    	$client = new GuzzleHttp\Client();

    	$response = $client->get($this->url . 'send_sms' , [
          'query' => [
            'login' => $this->login,
            'pass' => $this->pass,
            'to' => $this->to,
            'message' => $message]
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
