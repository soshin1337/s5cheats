
<?php
require_once '../core/db.php';
$product_id = 1; // НАСТРОЙКА ID ЧИТА
$stmt = $pdo->prepare("SELECT product_name, price_day, price_week, price_month FROM products WHERE product_id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
    die("Продукт не найден");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="читы на игры, купить читы, читы пабг, читы батлбит, s5cheats, colapse, купить читы дешево, читы приват, приватные читы, приватные читы на игры">
    <meta name="description" content="s5cheats - купи надежные читы, по выгодной цене">
    <script src="https://kit.fontawesome.com/03002bcdc4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/colors.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="shortcut icon" href="/../images/favicon.ico" />
    <title>s5cheats</title>
</head>
<body>
    <div class="page">
        <div id="navbar"></div>
    <main>
        <div class="search">
        <h1>Каталог <span>игр</span></h1>
        <p class="dont">Не можешь найти нужную игру?<br>
            Воспользуйся поиском</p>
        <input type="search" name="search" id="search" placeholder="Название игры" class="search">
        </div>

        <div class="products">
            <div id="searchResults" class="products-container">
                <a href="/products/dayz-choose">
                <div data-name="dayz" class="item dayz">
                    <div class="item-img">
                    <img src="../images/dayz-logo.png" height="32px" width="32px" alt="">
                </div>
                </div>
            </a>
            <a href="/products/apex-choose">
                <div data-name="apex" class="item apex">
                    <div class="item-img">
                    <img src="../images/apex.png" height="32px" width="32px" alt="">
                </div>
            </div>
        </a>
        <a href="/products/valorant-choose">
            <div data-name="valorant" class="item valorant">
                <div class="item-img">
                <img src="../images/valorant.png" height="32px" width="32px" alt="">
            </div>
        </div>
    </a>
    <a href="/products/gta-choose">
        <div data-name="gta" class="item gta">
            <div class="item-img">
            <img src="../images/gta.png" height="32px" width="32px" alt="">
        </div>
        </div>
        </a>
        <a href="/products/rust-choose">
        <div data-name="rust" class="item rust">
            <div class="item-img">
            <img src="../images/rust.png" height="32px" width="32px" alt="">
        </div>
        </div>
        </a>
        <a href="/products/cs-choose">
        <div data-name="cs2" class="item cs2">
            <div class="item-img">
            <img src="../images/cs2.png" height="32px" width="32px" alt="">
        </div>
        </div>
        </a>
        <a href="/products/battlefield-choose">
        <div data-name="battlefield" class="item battlefield">
            <div class="item-img">
            <img src="../images/battlefield.png" height="32px" width="32px" alt="">
        </div>
        </div>
        </a>
        <a href="/products/stalcraft-choose">
        <div data-name="stalcraft" class="item stalcraft">
            <div class="item-img">
            <img src="../images/stallcraft.png" height="32px" width="32px" alt="">
        </div>
        </div>
    </a>
    <a href="/products/warzone-choose">
        <div data-name="warzone" class="item warzone">
            <div class="item-img">
            <img src="../images/warzone.png" height="32px" width="32px" alt="">
        </div>
        </div>
        </a>
        <a href="/products/dota-choose">
        <div data-name="dota2" class="item dota2">
            <div class="item-img">
            <img src="../images/dota2.png" height="32px" width="32px" alt="">
        </div>
        </div>
        </a>
        <a href="/products/warface-choose">
        <div data-name="warface" class="item warface">
            <div class="item-img">
            <img src="../images/warface.png" height="32px" width="32px" alt="">
        </div>
        </div>
        </a>
        <a href="/products/escape-from-tarkov-choose">
            <div data-name="escape" class="item escape">
                <div class="item-img">
                <img src="../images/escape.png" height="32px" width="32px" alt="">
            </div>
            </div>
            </a>
        </div>
    </main>

    <div id="footer"></div>
</div>


<script src="/js/index.js"></script>
<script src="/js/search.js"></script>
</body>
</html>