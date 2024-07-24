<?php
require_once "config.php";
require_once "../api/api_funcs.php";

$apiKey = __ANYPAY__['apiKey'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $REMOTE_IP = $_SERVER['REMOTE_ADDR'];
    $merchant_id = $_GET['merchant_id'] ?? '';
    $pay_id = $_GET['pay_id'] ?? ''; // Внутренний айдишник
    $amount = $_GET['amount'] ?? '';
    $currency = $_GET['currency'] ?? '';
    $email = $_GET['email'] ?? '';
    $status = $_GET['status'] ?? '';
    $sign = $_GET['sign'] ?? '';

    $md5_sign = array(
        $merchant_id, 
        $amount, 
        $pay_id,
        $apiKey
    );

    // $anypay = new Anypay();
    // $response = $anypay->getServers($pay_id);
    // $allowed_ips = $response['result']['ip'];
    // $allowed_ips = array(
    //     '185.162.128.38', 
    //     '185.162.128.39', 
    //     '185.162.128.88'
    // );

    $getSign = md5(implode(":", $md5_sign)); 
    if($sign != $getSign){
        http_response_code(400);
        die(json_encode(['error' => 'Unauthorized']));
    }

    if ($status === 'paid') {
    // ВЫДАЕМ ТОВАР
        try{
            if (!isUserExists($email)) {
                $result = createUser($email);
                $owner_id = $result['id'];
                $password = $result['password'];

                $send_result = sendMail($email, 
                "Регистрация на s5cheats.ru", 
                "Спасибо за покупку! Товар ждёт Вас в личном кабинет на сайте s5cheats.ru" 
                . PHP_EOL . "Логин: $email" . PHP_EOL . "Пароль: $password"
                );
            }else{
                $send_result = sendMail($email, 
                "Заказ #$pay_id", 
                "Спасибо за покупку!" . PHP_EOL . "Товар ждёт Вас в личном кабинете." 
                );
            }
           try
           {
                $result = processOrder($pay_id, $amount);
                if($result === true){
                    http_response_code(200);
                    die('OK');
                }
            }   
            catch (Exception $e) {
                http_response_code(400);
                die(json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE));
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
        }
    } else {
        http_response_code(400);
        echo(json_encode(['status' => $status]));
    }
}
