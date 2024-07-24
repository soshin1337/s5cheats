
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
    <meta name="keywords"
        content="читы на игры, купить читы, читы пабг, читы батлбит, s5cheats, colapse, купить читы дешево, читы приват, приватные читы, приватные читы на игры">
    <meta name="description" content="s5cheats - купи надежные читы, по выгодной цене">
    <script src="https://kit.fontawesome.com/03002bcdc4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="..\css\fonts.css">
    <link rel="stylesheet" href="..\css\colors.css">
    <link rel="stylesheet" href="..\css\product.css">
    <link rel="stylesheet" href="..\css\header.css">
    <link rel="stylesheet" href="..\css\footer.css">
    <link rel="stylesheet" href="..\css\animation.css">
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <title>s5cheats</title>
</head>

<body>
    <div class="page">
        <div id="navbar"></div>

        <main>
            <div class="gameplay-container">
                <img class="gameplay" src="/products/images/dayz/img4.jpeg" alt="">
            </div>
            <div class="cheat-container">
                <h1 class="cheat-name"><?= $product['product_name'] ?></h1>
                <div class="icons">
                    <!--<div class="game-icon">
                        <img src="..\products\images-logo\dayz-logo.png" alt="DayZ LogoType">
                        <p>DullWave</p>
                    </div>
					-->
                    <div class="undetect-icon">
                        <i class="fa-solid fa-bolt"></i>
                        <p>UNDETECTED</p>
                    </div>
                </div>
                <p class="cheat-desc"><?= $product['product_name'] ?> —  один из топовых провайдеров приватного ПО для различных игр. 
				Данный софт на DayZ, зарекомендовал себя с лучшей стороны, регулярные обновления, 
				хороший функционал, много положительных отзывов и все это по доступной цене!</p>
                <div class="cheat-functions">
                    <p class="default-functions">ОСНОВНЫЕ ФУНКЦИИ</p>
                    <div class="functions">
                        <!-- в css стоит свойство переноса когда контент будет подходить к max-width 500px -->
                        
                        <!-- Для добавления новой "ОСНОВНЫЕ ФУНКЦИИ" вам не обходимо добавить новый класс  -->
                        <!-- пример Html -->
                        <!--
                            <div class="название класса">
                                <div class="circle"></div>
                                имя
                            </div>
                        -->

                        <!-- далее пройти в css в products.css -->

                        <!-- после добавить имя нового класса в 
                            main .cheat-container .cheat-functions .functions .aimbot,
                            .players, это названия класса который уже есть
                            .misc,    это названия класса который уже есть
                            .speed,   это названия класса который уже есть
                            .invMove, это названия класса который уже есть
                            .velocity,это названия класса который уже есть
                            .killAura,это названия класса который уже есть
                            .phase,   это названия класса который уже есть
                            .InvCleaner после данного класса и последующих надо ставить запятую
                            .название класса
                        -->

                        <!-- после в products.css с пускаемся по ниже и находим это  -->

                        <!-- main .cheat-container .cheat-functions .functions .InvCleaner .circle {
                            width: 8px;
                            height: 8px;
                            border-radius: 100%;
                            background-color: rgba(4, 56, 246, 0.41);
                            } 
                        -->
                        <!-- и уже после данного свойства вставляем это -->
                        <!--  main .cheat-container .cheat-functions .functions .названия класса .circle {
                            width: 8px;
                            height: 8px;
                            border-radius: 100%;
                            background-color: и цвет который вы хотите назначить;
                            }  -->

                        <div class="aimbot">
                            <div class="circle"></div>
                            Aimbot
                        </div>
                        <div class="players">
                            <div class="circle"></div>
                            ESP
                        </div>
                        <div class="misc">
                            <div class="circle"></div>
                            Misc
                        </div>
                      
                    </div>

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
</div>        </main>
        <div class="screenshots">
            <h1>Скриншоты игры</h1>
            <div class="screenshots-container">
                <div class="item">
                    <a href="#img1">
                        <img src="..\products\images\dayz\helicopter\dayz-helicopter1.png" alt="">
                    </a>
                    <a href="#" class="lightbox animated-element" id="img1">
                        <span style="background-image: url('images/dayz/helicopter/dayz-helicopter.png')"></span>
                    </a>
                </div>
                <div class="item">
                    <a href="#img2">
                        <img src="..\products\images\dayz\helicopter\dayz-helicopter2.png" alt="">
                    </a>
                    <a href="#" class="lightbox animated-element" id="img2">
                        <span style="background-image: url('images/dayz/helicopter/dayz-helicopter2.png')"></span>
                    </a>
                </div>
                <div class="item">
                    <a href="#img3">
                        <img src="..\products\images\dayz\helicopter\dayz-helicopter3.png" alt="">
                    </a>
                    <a href="#" class="lightbox animated-element" id="img3">
                        <span style="background-image: url('images/dayz/helicopter/dayz-helicopter3.png')"></span>
                    </a>
                </div>

            </div>
        </div>

        <div class="product__data">
            <div class="product__data-inner">
                <div class="product__data-left">

                    <div class="product__description-inner">
                        <div class="product__description-top">
                            <button class="product__description-btn">Описание</button>
                            <button class="product__description-btn">История обновлений</button>
                        </div>

                        <div class="product__description-body">
                            <ul class="product-description-item">
                                <li class="product-description-list">
                                    <a class="product-description-link" href="#">
                                        <div class="product-description-head">
                                            <span class="product-description-head--span malibu-span"></span>Aimbot
                                            <div class="open__icon">
                                                <svg class="minus" fill="none" height="2" viewBox="0 0 10 2" width="10"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10 2.42469e-05H6.11111L5.5 0L5 2.42469e-05H3.88889H0V2H3.88889H5L5.5 1.99998L6.11111 2H10V2.42469e-05Z"
                                                        fill="#16181C"></path>
                                                </svg>
                                                <svg class="plus" fill="none" height="10" viewBox="0 0 2 10" width="2"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.99998 10L1.99998 6.11111L2 5.5L1.99998 5L1.99998 3.88889L1.99998 0L0 -8.74228e-08L-1.69989e-07 3.88889L-2.18557e-07 5L2.40783e-05 5.5L-2.67125e-07 6.11111L-4.37114e-07 10L1.99998 10Z"
                                                        fill="#16181C"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="product-description-text animated-element" style="display: none;">
                                            <ul class="description">

<li>Enable Silent Aimbot - Включить сайлент аим</li> 
<li>Enable Default Aimbot - Включить стандартный аим </li>
<li>Fov - Фов </li>
<li>Smooth - Плавность </li>
<li>Aim on Players - Аим на игроков </li>
<li>Aim on Zombies - Аим на Зомби</li>

                                            </ul>
                                        </div>
                                    </a>
                                </li>
                                <li class="product-description-list">
                                    <a class="product-description-link" href="#">
                                        <div class="product-description-head">
                                            <span class="product-description-head--span electric-violet-span"></span>ESP
                                            <div class="open__icon">
                                                <svg class="minus" fill="none" height="2" viewBox="0 0 10 2" width="10"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10 2.42469e-05H6.11111L5.5 0L5 2.42469e-05H3.88889H0V2H3.88889H5L5.5 1.99998L6.11111 2H10V2.42469e-05Z"
                                                        fill="#16181C"></path>
                                                </svg>
                                                <svg class="plus" fill="none" height="10" viewBox="0 0 2 10" width="2"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.99998 10L1.99998 6.11111L2 5.5L1.99998 5L1.99998 3.88889L1.99998 0L0 -8.74228e-08L-1.69989e-07 3.88889L-2.18557e-07 5L2.40783e-05 5.5L-2.67125e-07 6.11111L-4.37114e-07 10L1.99998 10Z"
                                                        fill="#16181C"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="product-description-text animated-element" style="display: none;">
                                            <ul class="description">
											
<li>Enable Esp Box on Players - Включить есп боксы на Игроков</li> 
<li>Enable Esp box on Zombies - Включить есп боксы на Зомби </li>
<li>Loot Distance - Дистанция лута </li>
<li>Esp Cars - Есп на автомобили </li>
<li>Esp Skeleton - Есп Скелеты </li>
<li>Enable Esp Distance - Включить дистанцию</li> 
<li>Enable show FOV - включить фов </li>
<li>Esp Locations - Локации </li>
<li>Villages - Деревни </li>
<li>City - Города </li>
<li>Mil Bases - Военные базы </li>
<li>Airfields - Аэропорты </li>
<li>Others - Другое </li>
<li>Esp Loot - Лут есп </li>
<li>FOV - Фов </li>
<li>No Grass - Без травы ( Повышает FPS в игре )</li>
                                                
                                            </ul>
                                        </div>
                                    </a>
                                </li>
																
                                <li class="product-description-list">
                                    <a class="product-description-link" href="#">
                                        <div class="product-description-head">
                                            <span class="product-description-head--span shocking"></span>Misc
                                            <div class="open__icon">
                                                <svg class="minus" fill="none" height="2" viewBox="0 0 10 2" width="10"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10 2.42469e-05H6.11111L5.5 0L5 2.42469e-05H3.88889H0V2H3.88889H5L5.5 1.99998L6.11111 2H10V2.42469e-05Z"
                                                        fill="#16181C"></path>
                                                </svg>
                                                <svg class="plus" fill="none" height="10" viewBox="0 0 2 10" width="2"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.99998 10L1.99998 6.11111L2 5.5L1.99998 5L1.99998 3.88889L1.99998 0L0 -8.74228e-08L-1.69989e-07 3.88889L-2.18557e-07 5L2.40783e-05 5.5L-2.67125e-07 6.11111L-4.37114e-07 10L1.99998 10Z"
                                                        fill="#16181C"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="product-description-text animated-element" style="display: none;">
                                            <ul class="description">
<li>Always day - Всегда день</li>
<li>Debug Camera - Дебаг камера</li>
<li>Panic Key [DELETE] - Кнопка экстренного выключения чита. ( Очень помогает при проверках Админов )</li> 
<li>Noclip - Ноклип</li>
<li>Health players/zombies/animals - Показ здоровья игроков/зомби/животных</li> 
<li>Show player inventory- Показ инвентаря игрока</li>

                                            </ul>
                                        </div>
                                    </a>
                                </li>
								
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="product__data-right">
                    <div class="product__right-stats">
                        <div class="product__stats-title">
                            <h3>Характеристики</h3>
                            <div class="tooltip">
                                <span>?</span>
                                <p class="tooltip-text animated-element" style="display: none;">Минимальные
                                    характеристики</p>
                            </div>
                        </div>
                        <div class="product__stats-block">
                            <img src="..\products\images\windows.svg" alt="icon">
                            <div class="product__stats-block--body">
                                <p class="product__stats-block-body--title">ПОДДЕРЖИВАЕМЫЕ СИСТЕМЫ:</p>
                                <p class="product__stats-block-body--text">Windows 10</p>
                            </div>
                        </div>
                        <div class="product__stats-block">
                            <img src="..\products\images\cpu.svg" alt="icon">
                            <div class="product__stats-block--body">
                                <p class="product__stats-block-body--title">ПОДДЕРЖИВАЕМЫЕ ПРОЦЕССОРЫ:</p>
                                <p class="product__stats-block-body--text">intel & amd</p>
                            </div>
                        </div>
                        <div class="product__stats-block">
                            <img src="..\products\images\monitor.svg" alt="icon">
                            <div class="product__stats-block--body">
                                <p class="product__stats-block-body--title">ПОДДЕРЖИВАЕМЫЕ РЕЖИМЫ ИГРЫ:</p>
                                <p class="product__stats-block-body--text">-</p>
                            </div>
                        </div>
                        <div class="product__stats-block">
                            <img src="..\products\images\obs.svg" alt="icon">
                            <div class="product__stats-block--body">
                                <p class="product__stats-block-body--title">ОБХОД ЗАПИСИ В ОБС:</p>
                                <p class="product__stats-block-body--text">Нет</p>
                            </div>
                        </div>
                        <div class="product__stats-block">
                            <img src="..\products\images\frame.svg" alt="icon">
                            <div class="product__stats-block--body">
                                <p class="product__stats-block-body--title">АНТИЧИТ:</p>
                                <p class="product__stats-block-body--text">Внутриигровой</p>
                            </div>
                        </div>
                        <div class="product__stats-block">
                            <img src="..\products\images\mobile.svg" alt="icon">
                            <div class="product__stats-block--body">
                                <p class="product__stats-block-body--title">ВСТРОЕННЫЙ СПУФЕР:</p>
                                <p class="product__stats-block-body--text">нет</p>
                            </div>
                        </div>
                        <div class="product__stats-block">
                            <img src="..\products\images\mobile.svg" alt="icon">
                            <div class="product__stats-block--body">
                                <p class="product__stats-block-body--title">ТРЕБУЕМЫЙ ФОРМАТ ДИСКА:</p>
                                <p class="product__stats-block-body--text">GPT/MBR</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="footer"></div>
    </div>

    <script src="../js/choose.js"></script>
    <script src="../js/index.js"></script>
</body>

</html>
