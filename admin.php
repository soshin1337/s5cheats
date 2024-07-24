<?php
require_once 'core/db.php';
session_start();

$userId = $_SESSION['user_id'];

if (!isset($userId)) {
    header("Location: auth");
    die();
}

$stmt = $pdo->prepare("SELECT `group` FROM users WHERE id = ?");
$stmt->execute([$userId]);
$userGroup = $stmt->fetchColumn();

if ($userGroup != 1) {
    die("
<pre>
 _           _           _       _      _            _           _ 
| |__   ___ | |__   ___ | |   __| | ___| |_ ___  ___| |_ ___  __| |
| '_ \ / _ \| '_ \ / _ \| |  / _` |/ _ \ __/ _ \/ __| __/ _ \/ _` |
| | | | (_) | | | | (_) | | | (_| |  __/ ||  __/ (__| ||  __/ (_| |
|_| |_|\___/|_| |_|\___/|_|  \__,_|\___|\__\___|\___|\__\___|\__,_|
</pre>
<h2>Иди нахуй хохлина 🐖🐽</h3>
    ");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->execute([$_POST['delete']]);
        echo "Товар удален";
    } elseif (isset($_POST['add_product'])) {
        $stmt = $pdo->prepare("INSERT INTO products (product_name, price_day, price_week, price_month, manual_url, loader_url) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['name'], $_POST['price_day'], $_POST['price_week'], $_POST['price_month'], $_POST['manual_url'], $_POST['loader_url']]);
        $product_id = $pdo->lastInsertId();
        echo "Товар добавлен. ID: " . $product_id;
    } elseif (isset($_POST['add_keys'])) {
        $product_id = $_POST['product_id'];
        $product_type = $_POST['product_type'];
        
        if (!empty($_POST['keys_text'])) {
            $keys = explode("\n", trim($_POST['keys_text']));
            foreach ($keys as $key) {
                $key = trim($key);
                if (!empty($key)) {
                    $stmt = $pdo->prepare("INSERT INTO product_keys (product_id, product_type, product_key) VALUES (?, ?, ?)");
                    $stmt->execute([$product_id, $product_type, $key]);
                }
            }
        }
        
        if (isset($_FILES['keys_file']) && $_FILES['keys_file']['error'] == 0) {
            $keys = file($_FILES['keys_file']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($keys as $key) {
                $key = trim($key);
                if (!empty($key)) {
                    $stmt = $pdo->prepare("INSERT INTO product_keys (product_id, product_type, product_key) VALUES (?, ?, ?)");
                    $stmt->execute([$product_id, $product_type, $key]);
                }
            }
        }
        
        echo "Ключи добавлены";
    }
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

$products = $pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
foreach ($products as $key => $product) {
    $stmt = $pdo->prepare("SELECT product_type, COUNT(*) as count FROM product_keys WHERE product_id = ? GROUP BY product_type");
    $stmt->execute([$product['product_id']]);
    $keys = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    $products[$key]['day_keys'] = $keys[1] ?? 0;
    $products[$key]['week_keys'] = $keys[2] ?? 0;
    $products[$key]['month_keys'] = $keys[3] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>S5 Admin Panel</title>
</head>
<body>
    <h1>S5 Admin Panel</h1>
    
    <h2>Добавить товар</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Название товара" required><br><br>
        <input type="number" name="price_day" placeholder="Цена за день" required><br><br>
        <input type="number" name="price_week" placeholder="Цена за неделю" required><br><br>
        <input type="number" name="price_month" placeholder="Цена за месяц" required><br><br>
        <input type="text" name="manual_url" placeholder="Ссылка на мануал"><br><br>
        <input type="text" name="loader_url" placeholder="Ссылка на лоадер"><br><br>
        <button type="submit" name="add_product">Добавить товар</button>
    </form>

    <h2>Добавить ключи</h2>
    <form method="post" enctype="multipart/form-data">
        <select name="product_id" required>
            <?php foreach ($products as $product): ?>
                <option value="<?= $product['product_id'] ?>"><?= htmlspecialchars($product['product_name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <select name="product_type" required>
            <option value="1">День</option>
            <option value="2">Неделя</option>
            <option value="3">Месяц</option>
        </select><br><br>
        <textarea name="keys_text" rows="10" cols="40" placeholder="Вставьте ключи, каждый с новой строки"></textarea><br><br>
        <input type="file" name="keys_file"><br><br>
        <button type="submit" name="add_keys">Добавить ключи</button>
    </form>

    <h2>Список товаров:</h2>
    <ul>
    <?php foreach ($products as $product): ?>
        <li>
            ID: <?= htmlspecialchars($product['product_id']) ?>, 
            Название: <?= htmlspecialchars($product['product_name']) ?>, 
            День: <?= htmlspecialchars($product['price_day']) ?>, 
            Неделя: <?= htmlspecialchars($product['price_week']) ?>, 
            Месяц: <?= htmlspecialchars($product['price_month']) ?>,
            Мануал: <a href="<?= htmlspecialchars($product['manual_url']) ?>"><?= htmlspecialchars($product['manual_url']) ?></a>,
            Лоадер: <a href="<?= htmlspecialchars($product['loader_url']) ?>"><?= htmlspecialchars($product['loader_url']) ?></a>
            <form method="post" style="display:inline;">
                <input type="hidden" name="delete" value="<?= htmlspecialchars($product['product_id']) ?>">
                <button type="submit">Удалить</button>
            </form>
            <br>
            Ключей на день: <?= htmlspecialchars($product['day_keys']) ?>,
            На неделю:  <?= htmlspecialchars($product['week_keys']) ?>,
            На месяц: <?= htmlspecialchars($product['month_keys']) ?>
        </li>
        <br>
    <?php endforeach; ?>
    </ul>
</body>
</html>
