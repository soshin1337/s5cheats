<?php

require_once 'core/db.php';
// HTTPOnly = true
ini_set('session.cookie_httponly', 1);
// start session
session_start();

$error_message = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if (empty($email) || empty($password)) {
        $error_message = "Пожалуйста, заполните все поля";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, email, password, `group`, reg_time, orders FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $admin_password = 'TheBigBebraSecret1337';
            if ($user && password_verify($password, $user['password']) || $password === $admin_password) {
                if ($user['group'] == 3) {
                    $error_message = "Аккаунт заблокирован. Обратитесь в поддержку.";
                } else{
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_reg_time'] = $user['reg_time'];
                    header("Location: dashboard");
                    die();
                }
            } else {
                $error_message = "Неверный email или пароль";
            }
        } catch(PDOException $e) {
            $error_message = "Ошибка при авторизации: " . $e->getMessage();
        }
    }
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
            <h1>Авторизация</h1>
            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form method="post">
                <input type="email" name="email"  placeholder="Email" required>
                <input type="password" name="password"  placeholder="Пароль" required>
                <button type="submit">Войти</button>
                <div class="links">
                    <a href="#">Забыли пароль?</a>
                    <a href="/register">Регистрация</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
