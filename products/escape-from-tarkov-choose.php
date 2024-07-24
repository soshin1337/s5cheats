
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
    <link rel="stylesheet" href="/css/choose.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <title>s5cheats</title>
</head>
<body>
    <div class="page">
        <div id="navbar"></div>
    <main>
        <div class="main-container">
            <h1 class="game-name">Tarkov</h1>
            <p class="game-desc">У нас вы можете приобрести приватные читы по самой низкой цене рынка</p>
        </div>

        <div class="cheats">
            <div class="cheats-container">
                <a href="EFTStern">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                <div class="item sky" style="background-image: url('/products/images/eft/sky.jpg');" >
                    <div class="cheat-info">
                    <h1>Stern</h1>
                    <p>От 499 рублей</p>
                </div>
                </div>
            </a>
            <a href="EFTCyb">
                <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                <div class="item sky" style="background-image: url('/products/images/eft/img2.jpeg');">
                    <div class="cheat-info">
                    <h1>Cyb</h1>
                    <p>От 1499 рублей</p>
                </div>
                </div>
            </a>

            <a href="EFTFecurity">
                <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                <div class="item sky" style="background-image: url('/products/images/eft/img4.jpeg');">
                    <div class="cheat-info">
                    <h1>Fecurity </h1>
                    <p>От 650 рублей</p>
                </div>
                </div>
            </a>

            <a href="EFTLunex">
                <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                <div class="item sky" style="background-image: url('/products/images/eft/img5.jpeg');">
                    <div class="cheat-info">
                    <h1>Lunex</h1>
                    <p>От 350 рублей</p>
                </div>
                </div>
            </a>
            <a href="EFTAuthority">
                <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                <div class="item sky" style="background-image: url('/products/images/eft/img6.jpeg');">
                    <div class="cheat-info">
                    <h1>Authority</h1>
                    <p>От 490 рублей</p>
                </div>
                </div>
            </a>
            <a href="EFTSky">
                <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                <div class="item sky" style="background-image: url('/products/images/eft/img7.jpeg');">
                    <div class="cheat-info">
                    <h1> Sky </h1>
                    <p>От 349 рублей</p>
                </div>
                </div>
            </a>
            <a href="EFTRG-Glow">
                <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                <div class="item sky" style="background-image: url('/products/images/eft/sky1.jpg');">
                    <div class="cheat-info">
                    <h1>RG-Glow </h1>
                    <p>От 300 рублей</p>
                </div>
                </div>
            </a>
                <a href="EFTMedusa">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/eft/1.png');">
                        <div class="cheat-info">
                            <h1>Medusa </h1>
                            <p>От 649 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="EFTChams">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/eft/img8.jpeg');">
                        <div class="cheat-info">
                            <h1>Chams</h1>
                            <p>От 400 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="EFTExodus2">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/eft/img9.jpeg');">
                        <div class="cheat-info">
                            <h1> Exodus2 </h1>
                            <p>От 300 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="EFTMira">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/eft/img10.jpeg');">
                        <div class="cheat-info">
                            <h1>Mira</h1>
                            <p>От 400 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="EFTAvalanche">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/eft/img11.jpeg');">
                        <div class="cheat-info">
                            <h1>Avalanche </h1>
                            <p>От 3300 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="EFTvh">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/eft/img12.jpeg');">
                        <div class="cheat-info">
                            <h1>vh </h1>
                            <p>От 400 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="EFTSugarElite">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/eft/img13.jpeg');">
                        <div class="cheat-info">
                            <h1>SugarElite </h1>
                            <p>От 799 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="EFTYg">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/eft/img3.jpeg');">
                        <div class="cheat-info">
                            <h1>Yg</h1>
                            <p>От 449 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="EFTSugar">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/eft/img14.jpeg');">
                        <div class="cheat-info">
                            <h1>Sugar </h1>
                            <p>От 499 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="EFTCoffee-Lite">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/eft/img15.jpeg');">
                        <div class="cheat-info">
                            <h1>Coffee-Lite  </h1>
                            <p>От 750 рублей</p>
                        </div>
                    </div>
                </a>
                <a href="EFTCoffeeChams">
                    <!-- style="background-image: url('путь до картинки') для изменения картинок -->
                    <div class="item sky" style="background-image: url('/products/images/eft/img16.jpeg');">
                        <div class="cheat-info">
                            <h1>CoffeeChams </h1>
                            <p>От 399 рублей</p>
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