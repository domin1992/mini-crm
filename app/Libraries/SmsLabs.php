<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class SmsLabs{
    private $appKey;
    private $secretKey;
    private $senderId;

    private $client;

    function __construct(){
        $this->appKey = env('SMSLABS_APP_KEY');
        $this->secretKey = env('SMSLABS_SECRET_KEY');
        $this->senderId = env('SMSLABS_SENDER_ID');
        $this->client = $this->client();
    }

    public function send($recipients = [], $message = ''){
        $options = ['form_params' => $this->getBody($recipients, $message)];
        $options['auth'] = [$this->appKey, $this->secretKey];
        $response = json_decode($this->client->put('/apiSms/sendSms', $options)->getBody(), true);

        if($response['status'] === 'success'){
            return true;
        }
        else{
            return false;
        }
    }

    public function client(){
        $client = new Client([
            'base_uri' => 'https://apidev.smslabs.net.pl',
            'timeout'  => 2.0,
        ]);
        return $client;
    }

    public function getBody($recipients = [], $message = ''){
        $params = [
            'phone_number' => $recipients,
            'sender_id' => $this->senderId,
            'message' => $message,
        ];

        return $params;
    }
}