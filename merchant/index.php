<?php

require_once "anypay.php";
require_once "../core/db.php";
require_once "../api/api_funcs.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $payment_method = isset($_POST["payment_method"]) ? $_POST["payment_method"] : "";
    $promocode = isset($_POST["promocode"]) ? $_POST["promocode"] : "";
    $count = isset($_POST["count"]) ? $_POST["count"] : "";
    $product_id = isset($_POST["product_id"]) ? $_POST["product_id"] : "";
    $product_type = isset($_POST["product_type"]) ? $_POST["product_type"] : "";

    // paypal hardcoded
    if($payment_method == 'paypal'){
        header("Location: https://discord.gg/5KRZmaMb8k");
        die();
    }

    $stmt = $pdo->prepare("SELECT product_name, price_day, price_week, price_month FROM products WHERE product_id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Продукт не найден");
    }
    switch ($product_type) {
        case 1:
            $price = $product["price_day"];
            $duration = "1 день";
            break;
        case 2:
            $price = $product["price_week"];
            $duration = "1 неделю";
            break;
        case 3:
            $price = $product["price_month"];
            $duration = "1 месяц";
            break;
        default:
            die("Неверный тип продукта");
    }

    $desc = $product["product_name"] . " на " . $duration . " " . "(" . $count . " шт)";

    $anypay = new Anypay();
    $response = $anypay->createPayment($payment_method, $price * $count, $desc, $email);

    // var_dump($response);
    //echo($response);
    $data = json_decode($response, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        if (!isset($data["result"])) {
            die();
        }
        $transaction_id = $data["result"]["transaction_id"];
        $pay_id = $data["result"]["pay_id"];
        $payment_url = $data["result"]["payment_url"];
        $owner_id = null;

        if (!empty($transaction_id)) {

            if (!isUserExists($email)) {
                // try {
                //     $result = createUser($email);
                //     $owner_id = $result['id'];
                //     $password = $result['password'];

                //     $send_result = sendMail($email, 
                //     "Регистрация на s5cheats.ru", 
                //     "Пароль для доступа в личный кабинет на сайте s5cheats.ru" 
                //     . PHP_EOL . "Логин: $email" . PHP_EOL . "Пароль: $password"
                //     );

                //     if(!$send_result){
                //         die("Ошибка при отправке письма!");
                //     }
                //     // echo "Пользователь создан.";
                //     // echo "ID: {$result['id']}";
                //     // echo "Пароль: $password\n";
                // } catch (Exception $e) {
                //     //echo $e->getMessage();
                //     exit($e->getMessage());
                // }
            }
            else {
                $owner_id = getIdByEmail($email);
            }
            try {
                // $stmt = $pdo->prepare("INSERT INTO temp_orders (order_id, owner_id, product_id, product_type, count) VALUES (:order_id, :owner_id, :product_id, :product_type, :count)");
                // $result = $stmt->execute([
                //     ":order_id" => $pay_id,
                //     ":owner_id" => $owner_id,
                //     ":product_id" => $product_id,
                //     ":product_type" => $product_type,
                //     ":count" => $count,
                // ]);
                $stmt = $pdo->prepare("INSERT INTO temp_orders (order_id, owner_email, product_id, product_type, count) VALUES (:order_id, :owner_email, :product_id, :product_type, :count)");
                $result = $stmt->execute([
                    ":order_id" => $pay_id,
                    ":owner_email" => $email,
                    ":product_id" => $product_id,
                    ":product_type" => $product_type,
                    ":count" => $count,
                ]);

                if ($result) {
                    header("Location: " . $payment_url);
                } else {
                    echo "Ошибка PDO";
                }
            } catch (PDOException $e) {
                echo "Ошибка: " . $e->getMessage();
            }
        }
    } else {
        echo "JSON parse error: " . json_last_error_msg();
    }
} else {
    // Если запрос не POST, выводим сообщение об ошибке
    echo "иди нахуй";
}
