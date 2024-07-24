<?php
require_once 'core/db.php';

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$product_type = isset($_GET['product_type']) ? intval($_GET['product_type']) : 0;

$stmt = $pdo->prepare("SELECT product_name, price_day, price_week, price_month FROM products WHERE product_id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Продукт не найден");
}

switch ($product_type) {
    case 1:
        $price = $product['price_day'];
        $duration = "1 день";
        break;
    case 2:
        $price = $product['price_week'];
        $duration = "1 неделю";
        break;
    case 3:
        $price = $product['price_month'];
        $duration = "1 месяц";
        break;
    default:
        die("Неверный тип продукта");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['product_name'] ?> на <?= $duration ?></title>
    <link rel="stylesheet" href="css/payment_form.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <script src="https://kit.fontawesome.com/03002bcdc4.js" crossorigin="anonymous"></script>
</head>
<body>
<?php require "header.php"; ?>
    <main>
        <div class="payment-wrapper">
             <div class="payment-container">
                <h1><?= $product['product_name'] ?> на <?= $duration ?> - <?= $price ?>р</h1>
                <p class="total-amount"><b>Итого: </b><?= $price ?>р</p>
                <form id="checkout" action="merchant/" method="POST" autocomplete="off">
                    <div class="form-group">
                        <input id="count" name="count" type="number" placeholder="Количество" min="1" max="1000" value="1" required>
                        <input id="email" name="email" type="email" placeholder="Email" required>
                        <input type="hidden" id="product_id" name="product_id" type="number" min="1" max="10000" value="<?= $product_id ?>">
                        <input type="hidden" id="product_type" name="product_type" type="number" min="1" max="10000" value="<?= $product_type ?>">
                        
                    </div>
                    <h2>Способ оплаты:</h2>
                    <div class="payment-methods">
                        <a href="javascript:void(0);" class="payment-method active" data-method="sbp">
                            <img src="images/spb.png" alt="СБП">
                            <span>Система быстрых платежей (7.9%)</span>
                        </a>
                        <a href="javascript:void(0);" class="payment-method" data-method="card">
                            <img src="images/cards.png" style="width: 60px" alt="Карта">
                            <span>Банковская картой РФ (7.9%)</span>
                        </a>
                        <a href="javascript:void(0);" class="payment-method" data-method="ym">
                            <img src="images/ym.png" style="width: 32px" alt="ЮMoney">
                            <span>ЮMoney (4.9%)</span>
                        </a>
                        <a href="javascript:void(0);" class="payment-method" data-method="usdt">
                            <img src="images/usdt.png" style="width: 32px" alt="USDT">
                            <span>USDT (0%)</span>
                        </a>
                    </div>
                    <input type="hidden" name="payment_method" id="payment_method" value="sbp">
                    <div id="promocode_block" class="form-group">
                        <input id="promocode" name="promocode" type="text" placeholder="Промокод">
                        <button type="button" class="apply-promo" onclick="alert('Промокод не найден')">Применить</button>
                    </div>
                    <button type="submit" class="submit-btn">Оплатить</button>
                </form>
            </div>
            <div class="info-container">
                <p class="info-title">После оплаты вы получаете:</p>
                <ul class="info-list">
                    <li>ключ</li>
                    <li>файл запуска чита (loader)</li>
                    <li>инструкцию</li>
                    <li>тех. поддержку в нашей группе дискорд</li>
                </ul>
                <p class="info-title">Кроме того:</p>
                <ul class="info-list">
                    <li>после первой покупки на нашем сайте, у вас автоматически создаётся личный кабинет (пароль высылается на почту)</li>
                    <li>в нашей группе дискорд вы сможете получать новости обновлений чита и прочую информацию</li>
                    <li>постоянные клиенты получают доступ в нашу ПРИВАТНУЮ группу дискорд</li>
                </ul>
                <p class="info-title">Если у вас возникли проблемы или вопросы, а так же вам необходима консультация по читу:</p>
                <div class="contact-button">
                <button type="submit" class="contact-btn">Telegram</button>
                <button type="submit" class="contact-btn">Discord</button>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.payment-method').click(function() {
            $('.payment-method').removeClass('active');
            $(this).addClass('active');
            $('#payment_method').val($(this).data('method'));
        });
        $('#count').on('change', function() {
        var count = $(this).val();
        var newTotal = <?= $price; ?> * count;
        $('.total-amount').html('<b>Итого:</b> ' + newTotal + 'р');
        $('#amount').val(newTotal);
     });
    });
</script>


</body>
</html>
