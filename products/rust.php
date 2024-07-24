
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
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/colors.css">
    <link rel="stylesheet" href="/css/product.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <title>s5cheats</title>
</head>
<body>
    <div class="page">
    <div id="navbar"></div>
    
    <main>
        <div class="gameplay-container">
        <img class="gameplay" src="images/dayz.webp" alt="">
    </div>
        <div class="cheat-container">
            <h1 class="cheat-name"><?= $product['product_name'] ?></h1>
            <div class="icons">
            <div class="game-icon">
                <img src="images-logo/dayz-logo.png" alt="DayZ LogoType">
                <p>DayZ</p>
            </div>
            <div class="undetect-icon">
                <i class="fa-solid fa-bolt"></i><p>UNDETECTED</p>
            </div>
        </div>
        <p class="cheat-desc"><?= $product['product_name'] ?> — ipsum dolor sit amet consectetur adipisicing elit. Assumenda necessitatibus debitis possimus porro molestiae error nesciunt voluptatem vitae vel tempora libero voluptatibus, quis quod similique alias voluptas, dolores aperiam facilis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda necessitatibus debitis possimus porro molestiae error nesciunt voluptatem vitae vel tempora libero voluptatibus, quis quod similique alias voluptas, dolores aperiam facilis.</p>
        <div class="cheat-functions">
            <p class="default-functions">ОСНОВНЫЕ ФУНКЦИИ</p>
            <div class="functions">
            <div class="aimbot">
                <div class="circle"></div>
                Aimbot
            </div>
            <div class="players">
                <div class="circle"></div>
                Players
            </div>
            <div class="misc">
                <div class="circle"></div>
                Misc
            </div>
        </div>
        
    </div>
    <div class="reseller">
        <p><i class="fa-regular fa-eye"></i> Мы являемся официальным реселлером данного товара</p>
    </div>
    </div>
    <div class="pay">
    <div class="pay-container">
        <p class="choose">Тарифный план:</p>
        <div class="buy-buttons">
            <a class="btn active" onclick="switchTab(0)" price="<?= $product['price_day'] ?>" type="1" days="1">1 день</a>
            <a class="btn" onclick="switchTab(1)" price="<?= $product['price_week'] ?>" type="2" days="7">7 дней</a>
            <a class="btn" onclick="switchTab(2)" price="<?= $product['price_month'] ?>" type="3" days="30">30 дней</a>
        </div>
        <div class="buy-container">
            <p id="priceText" class="price">₽<?= $product['price_day'] ?> <span class="days">/ 1 день</span></p>
            <a id="payLink" href="/pay?product_id=<?= $product_id ?>&product_type=1" class="buy">ПЕРЕЙТИ К ОПЛАТЕ</a>
        </div>
    </div>
</div>    </main>
    <div class="screenshots">
        <h1>Скриншоты игры</h1>
        <div class="screenshots-container">
            <div class="item">
            <img src="images/sky-screen.png" alt="">
        </div>
        <div class="item">
            <img src="images/sky-screen-2.png" alt="">
        </div>
        <div class="item">
            <img src="images/sky-screen-3.png" alt="">
        </div>
        </div>
    </div>
    <div id="footer"></div>
</div>

    <script src="/js/choose.js"></script>
    <script src="/js/index.js"></script>
</body>
</html>