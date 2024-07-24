
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
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="читы на игры, купить читы, читы пабг, читы батлбит, s5cheats, colapse, купить читы дешево, читы приват, приватные читы, приватные читы на игры">
    <meta name="description" content="s5cheats - купи надежные читы, по выгодной цене">
    <script src="https://kit.fontawesome.com/03002bcdc4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/colors.css">
    <link rel="stylesheet" href="/css/choose.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <title>s5cheats</title>
</head>
<body> 
<!-- Перевод -->
<div class="gtranslate_wrapper"></div>
<script>window.gtranslateSettings = {"default_language":"ru","native_language_names":true,"languages":["ru","en","zh-CN"],"wrapper_selector":".gtranslate_wrapper","alt_flags":{"en":"usa"}}</script>
<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

    <!-- Перевод -->
    <div class="page">
        <div id="navbar"></div>
    <main>
        <div class="main-container">
            <h1 class="game-name">Counter-Strike 2</h1>
            <p class="game-desc">У нас вы можете приобрести приватные читы по самой низкой цене рынка</p>
        </div>

        <div class="cheats">
            <div class="cheats-container">
                <a href="cs-hellhit">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/cs/4.png');">
                        <div class="cheat-info">
                            <h1>hellhit</h1>
                            <p>От 89 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="cs-xone">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/cs/1.png');">
                        <div class="cheat-info">
                            <h1>xone</h1>
                            <p>От 99 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="cs-Fecurity">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/cs/2.png');">
                        <div class="cheat-info">
                            <h1> Fecurity </h1>
                            <p>От 339 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="cs-Advance">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/cs/3.png');">
                        <div class="cheat-info">
                            <h1>Advance </h1>
                            <p>От 30 рублей</p>
                        </div>
                    </div>
                </a>
               
            </div>
        </div>
    </main>
        <div id="footer"></div>
</div>

<script src="/js/index.js"></script>
</body>
</html>