<?php  
require_once 'core/db.php';
// HTTPOnly = true
ini_set('session.cookie_httponly', 1);
// start session
session_start();


// Проверка, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    // header("Location: auth.php");
    header("Location: auth");
    die();
}

function logout(){
    // Очищаем все данные сессии
    $_SESSION = array();

    // Если используются сессионные куки, удаляем их
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Уничтожаем сессию
    session_destroy();
    header("Location: auth");
    die();
}

if (isset($_POST['logout']) && ($_POST['logout'] == true)) {
    logout();
}


$stmt = $pdo->prepare("SELECT orders, `group` FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$fetch = $stmt->fetch(PDO::FETCH_ASSOC);
// Проверяем группу
if($fetch['group'] == 3){
    logout();
    die();
}
// Получаем ордеры
$orders = $fetch['orders'];

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
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="shortcut icon" href="/images/favicon.ico">
    <script src="https://kit.fontawesome.com/03002bcdc4.js" crossorigin="anonymous"></script>
</head>
<body>
   <?php require_once "header.php"; ?>

    <main>
        <div class="dashboard-container">
            <section class="content">
                <div class="header">
                    <h1>Добро пожаловать, <?= htmlspecialchars($_SESSION['user_email']) ?></h1>
                    <div class="actions">
                        <button id="supButton">Техподдержка</button>
                        <form method="POST">
                            <button type="submit" name="logout" value="true">Выйти</button>
                        </form>
                    </div>
                </div>
                <div class="user-info">
                    <p>Количество покупок: <?= htmlspecialchars($orders) ?></p>
                    <p>Дата регистрации: <?= htmlspecialchars($_SESSION['user_reg_time']) ?></p>
                </div>
                <div class="purchased-items">
                    <h2>Купленные товары</h2>
                    <div class="items-list" id="items-list">
                        <!-- Initial items will be loaded here by JavaScript -->
                    </div>
                    <div class="load-btn">
                    <button id="load-more" class="loader-button" onclick="loadMoreItems()" style="display: none;">Загрузить еще</button>
                    </div>  
                </div>
            </section>
        </div>
    </main>
    
    <script src="js/dashboard.js"></script>


</body>
</html>
