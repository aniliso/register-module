<?php

namespace Modules\Register\Services;

use GuzzleHttp;

class SmsService
{
    private $username;
    private $password;
    private $vendorCode;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    private function generateXMLStringForSending()
    {
        $smsXMLElement = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><MainReportRoot></MainReportRoot>');
        $smsXMLElement->addChild('UserName', $this->username);
        $smsXMLElement->addChild('PassWord', $this->password);
        $smsXMLElement->addChild('Action', 4);
        return $smsXMLElement->asXML();
    }

    public function check()
    {
        $xml = $this->generateXMLStringForSending();
        $client = new GuzzleHttp\Client();
        $res = $client->request('POST', 'https://xmlapi.mobildev.com', [
            'headers' => [
                'Content-Type' => 'text/xml'
            ],
            'body' => $xml
        ]);
        return $res;
    }
}