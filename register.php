<?php
// register.php

require_once 'core/db.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['h-captcha-response']) && !empty($_POST['h-captcha-response'])){
        // get verify response
        $data = array(
              'secret' => "ES_6b6361551c2640459004513b44a83963",
              'response' => $_POST['h-captcha-response']
          );
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $verifyResponse = curl_exec($verify);
        $responseData = json_decode($verifyResponse);
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if($responseData->success){
            if (empty($email) || empty($password) || empty($confirm_password)) {
                $error_message = "Пожалуйста, заполните все поля";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_message = "Некорректный email адрес";
            } elseif ($password !== $confirm_password) {
                $error_message = "Пароли не совпадают"; 
            } else {
                try { 
                    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                    $stmt->execute([$email]);
                    
                    if ($stmt->fetchColumn()) {
                        $error_message = "Этот email уже зарегистрирован";
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
                        $stmt->execute([$email, $hashedPassword]);
                        $success_message = "Регистрация успешна!";
                    }
                } catch(PDOException $e) {
                    $error_message = "Ошибка при регистрации: " . $e->getMessage();
                }
            }
        } else { $error_message = "Ошибка верификации HCaptcha"; }
    } else { $error_message = "Ошибка. Решите капчу!"; }
}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/auth.css">
    <script src="https://kit.fontawesome.com/03002bcdc4.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php require "header.php"; ?>
    <main>
        <div class="login-container">
            <h1>Регистрация</h1>
            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php elseif (!empty($success_message)): ?>
                <div class="success-message"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <form method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <input type="password" name="confirm_password" placeholder="Повторите пароль" required>
                <div class="h-captcha" data-sitekey="0424a3a2-6dba-4982-947e-c020929e8eec" data-theme="dark" data-error-callback="onError"></div>
                <button type="submit">Зарегистрироваться</button>
                <div class="links">
                    <a href="#">Забыли пароль?</a>
                    <a href="auth">Авторизация</a>
                </div>
            </form>
        </div>
    </main>
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
</body>
</html>
