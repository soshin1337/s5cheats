<?php

function getHash($secretKey, $body){
    $jsonString = json_encode($body, JSON_UNESCAPED_SLASHES);
    $stringToHash = $secretKey . $jsonString;

    echo($stringToHash . PHP_EOL);
    $signature = sha1($stringToHash);
    return $signature;
}

function createP2P(){
    $secretKey = "";
    $user_uuid = "22f7fcf9-b90b-4205-bb49-cabcb0bcfee3";
    $amount = 500;
    $callback_url = "https://webhook.site/cfe48fa4-dd15-4a8b-a318-c918e94cb020";
    $bank_name = "sberbank";

    $body = [
        "user_uuid" => $user_uuid,
        "merchant_id" => "string",
        "bank_name" => $bank_name,
        "amount" => $amount,
        "callback_url" => $callback_url,
        "redirect_url" => "https://ya.ru/",
        "email" => "test@mail.ru",
        "customer_name" => "Ivan Vasiliev",
        "currency" => "rub",
        "payeer_identifier" => "payeer_identifier123",
        "payeer_ip" => "127.0.0.1",
        "payeer_card_number" => "2202205094125017",
        "payeer_type" => "trust",
        "lifetime" => 1000,
        "payment_method" => "card"
    ];

    //ksort($body);

    $signature = getHash($secretKey, $body);
    echo ("HASH: ". $signature . PHP_EOL);

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://bovatech.cc/v1/p2p_transactions',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($body, JSON_UNESCAPED_SLASHES),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Signature: ' . $signature
    )));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}


function createTopup(){
    $secretKey = "6500a670e740f88adb5960bfb0c92f4505b53972";
    $user_uuid = "22f7fcf9-b90b-4205-bb49-cabcb0bcfee3";
    $amount = 1337;
    $callback_url = "https://webhook.site/cfe48fa4-dd15-4a8b-a318-c918e94cb020";
    $bank_name = "sberbank";

    $ip = $_SERVER["REMOTE_ADDR"];
    $merchant_id = strval(rand(1000000, 9999999));
    $email = "test@mail.ru";

    $body = [
        "user_uuid" => $user_uuid,
        "merchant_id" => $merchant_id,
        "bank_name" => $bank_name,
        "amount" => $amount,
        "callback_url" => $callback_url,
        "redirect_url" => "https://ya.ru/",
        "email" => $email,
        // "customer_name" => "Ivan Vasiliev",
        "currency" => "rub",
        "payeer_identifier" => $email,
        //"payeer_ip" => $ip,
        "payeer_ip" => "127.0.0.1",
        "payeer_type" => "trust",
        "lifetime" => 1000,
        ];

    //ksort($body);

    $signature = getHash($secretKey, $body);
    echo ("HASH: ". $signature . PHP_EOL);

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://bovatech.cc/merchant/v1/deposits',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($body, JSON_UNESCAPED_SLASHES),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Signature: ' . $signature
    )));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

createTopup();

