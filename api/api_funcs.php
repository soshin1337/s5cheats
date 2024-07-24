<?php
#require_once __DIR__ . '/../core/db.php';
require_once '../core/db.php';
require_once "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($to, $subject, $body)
{
    $mail = new PHPMailer(true);
    try {
        // Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->CharSet = "utf-8";
        $mail->Host = "smtp.beget.com";
        $mail->SMTPAuth = true;
        $mail->Username = "admin@s5cheats.ru";
        $mail->Password = "2uhEW6owEFJ%";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port = 465;
        // Recipients
        $mail->setFrom("admin@s5cheats.ru", "s5cheats");
        $mail->addAddress($to);
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        // Content
        // $mail->isHTML(true); // Set email format to HTML
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $body;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        #echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

function generatePassword() {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789^!@#$*().';
    $password = '';
    for ($i = 0; $i < 10; $i++) {
        $password .= $chars[random_int(0, strlen($chars) - 1)];
    }
    return $password;
    #return "123";
}

function isUserExists($email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetchColumn() > 0;
}

function getIdByEmail($email) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    return $stmt->fetchColumn();
}

function createUser($email) {
    global $pdo;
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidArgumentException("Некорректный email");
    }
    
    $password = generatePassword();
   # return $password;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        $pdo->beginTransaction();
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $hashedPassword]);
        $userId = $pdo->lastInsertId();
        
        $pdo->commit();
        
        return [
            'id' => $userId,
            'password' => $password
        ];
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw new RuntimeException("Ошибка при создании пользователя: " . $e->getMessage());
    }
}

function processOrder($orderId, $amount) {
    global $pdo;
    
    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("SELECT * FROM temp_orders WHERE order_id = ?");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            throw new Exception("Заказ не найден");
        }

        //$userId = $order['owner_id'];
        $email = $order['owner_email'];
        $productId = $order['product_id'];
        $productType = $order['product_type'];
        $keyCount = $order['count'];

        // new system
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception("Пользователь не найден");
        }

        $userId = $user['id'];
        //


        $stmt = $pdo->prepare("SELECT id, product_key FROM product_keys WHERE product_id = ? AND product_type = ? LIMIT ?");
        $stmt->bindValue(1, $productId, PDO::PARAM_INT);
        $stmt->bindValue(2, $productType, PDO::PARAM_INT);
        $stmt->bindValue(3, $keyCount, PDO::PARAM_INT);
        $stmt->execute();
        
        $keys = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($keys) < $keyCount) {
            throw new Exception("Недостаточно доступных ключей");
        }

        $orderKey = $keyCount > 1 ? 'multiple' : $keys[0]['product_key'];
        $stmt = $pdo->prepare("INSERT INTO orders (order_id, owner_id, order_key, order_amount, order_date, product_id, product_type) VALUES (?, ?, ?, ?, NOW(), ?, ?)");
        $stmt->execute([$orderId, $userId, $orderKey, $amount, $productId, $productType]);


        if ($keyCount > 1) {
            $fileName = md5($orderId . ORDER_SALT) . ".txt";
            $filePath = "../orders/" . $fileName;
            file_put_contents($filePath, implode("\n", array_column($keys, 'product_key')));
        }

        $keyIds = array_column($keys, 'id');
        $placeholders = implode(',', array_fill(0, count($keyIds), '?'));
        $stmt = $pdo->prepare("DELETE FROM product_keys WHERE id IN ($placeholders)");
        $stmt->execute($keyIds);

        $stmt = $pdo->prepare("UPDATE users SET orders = orders + 1 WHERE id = ?");
        $stmt->execute([$userId]);

        $stmt = $pdo->prepare("DELETE FROM temp_orders WHERE order_id = ?");
        $stmt->execute([$orderId]);

        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        //echo $e->getMessage();
        throw $e;
        //return $e->getMessage();
    }
}

//processOrder('1234', 100);

// $stmt = $pdo->prepare("INSERT INTO temp_orders (order_id, owner_id, product_id, product_type, count) VALUES (:order_id, :owner_id, :product_id, :product_type, :count)");
// $result = $stmt->execute([
//     ":order_id" => 1234,
//     ":owner_id" => 2,
//     ":product_id" => 1,
//     ":product_type" => 1,
//     ":count" => 1,
// ]);

?>