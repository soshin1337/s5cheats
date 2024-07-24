<?php
require "config.php";

class Anypay {

    public $apiKey = __ANYPAY__['apiKey'];
    public $apiId = __ANYPAY__['apiId'];
    public $projectId = __ANYPAY__['projectId'];
    public $currency = 'RUB';

    public function createPayment($method, $amount, $desc, $email) {        
        if($amount < 300)
            $amount = 300;
        $apiKey = $this->apiKey;
        $apiId = $this->apiId;
        $projectId = $this->projectId;
        $currency = $this->currency;
        // global $apiKey, $apiId, $projectId, $currency;
        $payId = rand(1000000, 9999999);
        $body = [
            'project_id' => $projectId,
            'pay_id' => $payId,
            'amount' => $amount,
            'currency' => $currency,
            'desc' => $desc,
            'email' => $email,
            'method' => $method,
            // 'success_url' => 'https://'. $_SERVER['HTTP_HOST'] . '/payment_status?id=' . $payId,
            // 'fail_url' => 'https://'. $_SERVER['HTTP_HOST'] . '/payment_status?id=' . $payId
            //'success_url' => 'https://s5cheats.ru/payment_status?id=' . $payId,
        ];

        // return $body;

        $sign = hash('sha256', 'create-payment' . $apiId . $projectId . $payId . $amount . $currency . $desc . $method . $apiKey);
        $body['sign'] = $sign;

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://anypay.io/api/create-payment/' . $apiId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $body,
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: multipart/form-data'
        )));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function getPaymentInfo($pay_id) {
        $apiKey = $this->apiKey;
        $apiId = $this->apiId;
        $projectId = $this->projectId;
        $currency = $this->currency;
        $body = [
            'project_id' => $projectId,
            'pay_id' => $pay_id,
        ];

        // return $body;

        $sign = hash('sha256', 'payments' . $apiId . $projectId . $apiKey);
        $body['sign'] = $sign;

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://anypay.io/api/payments/' . $apiId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $body,
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: multipart/form-data'
        )));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function getServers($apiId) {
        $apiKey = $this->apiKey;
        $apiId = $this->apiId;

        $sign = hash('sha256', 'ip-notification' . $apiId . $apiKey);
        $body['sign'] = $sign;
    
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://anypay.io/api/ip-notification/' . $apiId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $body,
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: multipart/form-data'
        )));
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        return $response;
    }
 }

