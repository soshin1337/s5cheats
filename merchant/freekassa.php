<?php

// include "payments/create_pay.php";

// // echo freekassa();


// function freekassaZ() {
//     $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
//     $successUrl = $url . __WORK_DIR__ . "/success_pay.php?" . http_build_query($_POST);

//     // $price = $_POST['price'];
//     // $price = $_POST['price'];
//     // $price = $_POST['price'];
//     // $price = $_POST['price'];
//     // $price = $_POST['price'];
//     // $price = $_POST['price'];

//     // $_SESSION['p']              = $_POST['p'];
//     $_SESSION['successUrl']     = $successUrl;
//     // $_SESSION['order_id']       = $_POST['order_id'];
//     // $_SESSION['client_mail']    = $_POST['client_mail'];

//     $merchant_id = __FREEKASSA__['shopId'];
//     $currency = 'RUB';
//     // $order_id = $_POST['order_id'];
//     // $order_amount = $_POST['price'];
//     $secret_word = __FREEKASSA__['sc1'];


//     $data = [
//         'shopId'=>$merchant_id,
//         'paymentId'=>'1337',
//         'i'=>'6',
//         'email'=>'test@mail.ru',
//         'ip'=>$_SERVER['REMOTE_ADDR'],
//         'amount'=>200,
//         'currency'=>'RUB',
//         'nonce'=>time(),
//     ];
//     ksort($data);
//     // $sign = hash_hmac('sha256', implode('|', $data), __FREEKASSA__['api']);
//     $sign = hash_hmac('sha256', implode('|', $data), __FREEKASSA__['api']);

//     //$sign = md5($merchant_id.':'.'200'.':'.$secret_word.':'.$currency.':'.'1337');
//     //$sign = hash_hmac('sha256', implode('|', $data), $api_key);

//     $data['signature'] = $sign;

//     $request = json_encode($data);


//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, 'https://api.freekassa.com/v1/orders/create');
//     curl_setopt($ch, CURLOPT_HEADER, 0);
//     curl_setopt($ch, CURLOPT_FAILONERROR, 0);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_TIMEOUT, 10);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
//     $result = trim(curl_exec($ch));
//     curl_close($ch);

//     echo $result;
// }

// #freekassaZ();
// ?>

 <?php

// $merchant_id = '7012';
// $secret_word = 'secret';
// $order_id = '154';
// $order_amount = '100.11';
// $currency = 'RUB';
// $sign = md5($merchant_id.':'.$order_amount.':'.$secret_word.':'.$currency.':'.$order_id);
// $user['login'] = 'test';

 ?>


<?php


// $api_key = 'e1fe1bdbda1ef5c90f56f9202a1c8cfc';
// $shopId = '52873';



// $data = [
//     'shopId'=>$shopId,
//     'nonce'=>time(),
// ];
// ksort($data);
// $sign = hash_hmac('sha256', implode('|', $data), $api_key);
// $data['signature'] = $sign;

// $request = json_encode($data);

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://api.freekassa.com/v1/balance');
// curl_setopt($ch, CURLOPT_HEADER, 0);
// curl_setopt($ch, CURLOPT_FAILONERROR, 0);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_TIMEOUT, 10);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
// $result = trim(curl_exec($ch));
// echo($result);
// curl_close($ch);

// $response = json_decode($result, true);



$api_key = 'e1fe1bdbda1ef5c90f56f9202a1c8cfc';
$shopId = '52873';



$data = [
    'shopId'=>$shopId,
    'nonce'=>time(),
    'i'=>'13',
    'email'=>'ponos1337@mail.ru',
    'ip'=>$_SERVER['REMOTE_ADDR'],
    'amount'=>300,
    'currency'=>'RUB',
];
ksort($data);
$sign = hash_hmac('sha256', implode('|', $data), $api_key);
$data['signature'] = $sign;

$request = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.freekassa.com/v1/orders/create');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
$result = trim(curl_exec($ch));


// echo($result);



curl_close($ch);

$response = json_decode($result, true);
$test = json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

echo($test);

