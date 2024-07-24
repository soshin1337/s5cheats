<?php

require_once 'merchant/anypay.php';

$pay_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$pay_id) {
    die('Ошибка: ID платежа не указан');
}

$anypay = new Anypay();
$response = $anypay->getPaymentInfo($pay_id);
$response = json_decode($response, true);

if (!isset($response['result']['payments'])) {
    die('Ошибка: Платеж не найден');
}
$payment = reset($response['result']['payments']);
$transaction_id = $payment['transaction_id'];
$status = $payment['status'];
$statusInfo = [];

switch ($status) {
    case 'paid':
        $statusInfo['icon'] = 'fa-check-circle';
        $statusInfo['title'] = 'Оплата успешна';
        $statusInfo['message'] = 'Ваш платеж был успешно обработан. Спасибо за покупку!';
        $statusInfo['buttonText'] = 'В личный кабинет';
        $statusInfo['id'] = 'cpBtn';        

        break;
    case 'waiting':
        $statusInfo['icon'] = 'fa-spinner fa-spin';
        $statusInfo['title'] = 'Платеж в обработке';
        $statusInfo['message'] = 'Ваш платеж обрабатывается. Пожалуйста, подождите...';
        $statusInfo['buttonText'] = 'Обновить статус';
        $statusInfo['id'] = 'reloadBtn';        
        break;
    case 'expired':
        $statusInfo['icon'] = 'fa-times-circle';
        $statusInfo['title'] = 'Срок оплаты истёк';
        $statusInfo['message'] = 'Срок действия платежа истёк. Пожалуйста, создайте новый заказ.';
        $statusInfo['buttonText'] = 'Обновить статус';
        $statusInfo['id'] = 'reloadBtn';        
        break;               
    default:
        $statusInfo['icon'] = 'fa-times-circle';
        $statusInfo['title'] = 'Ошибка оплаты';
        $statusInfo['message'] = 'К сожалению, произошла ошибка при обработке вашего платежа. Пожалуйста, попробуйте еще раз.';
        $statusInfo['buttonText'] = 'Повторить оплату';
        $statusInfo['id'] = 'repayBtn';        
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статус платежа</title>
    <link rel="stylesheet" href="css/payment_status.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/03002bcdc4.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php require "header.php"; ?>
    <main>
        <div class="status-wrapper">
            <div class="status-container">
                <div class="status-icon">
                    <i class="fas <?php echo htmlspecialchars($statusInfo['icon']); ?>"></i>
                </div>
                <h1><?php echo htmlspecialchars($statusInfo['title']); ?></h1>
                <p class="status-message"><?php echo htmlspecialchars($statusInfo['message']); ?></p>
                <div class="order-details">
                    <h2>Детали заказа</h2>
                    <p><strong>Номер заказа:</strong> #<?php echo htmlspecialchars($payment['pay_id']); ?></p>
                    <p><strong>Сумма:</strong> <?php echo htmlspecialchars($payment['amount']) . ' ' . htmlspecialchars($payment['currency']); ?></p>
                    <p><strong>Дата:</strong> <?php echo htmlspecialchars($payment['date']); ?></p>
                </div>
                <div class="next-steps">
                    <h2>Что дальше?</h2>
                    <ul>
                        <?php if ($status === 'paid'): ?>
                            <li>Войдите в личный кабинет, чтобы получить товар</li>
                            <li>Ваш ключ и файл запуска чита (loader) ждут вас в вашем личном кабинете</li>
                            <li>Присоединяйтесь к нашей группе в Telegram для получения технической поддержки</li>
                        <?php elseif ($status === 'waiting'): ?>
                            <li>Платеж обрабатывается, пожалуйста, не закрывайте эту страницу.</li>
                            <li>Обычно это занимает не более 15 минут</li>
                            <li>Если у вас возникли вопросы, свяжитесь с нашей службой поддержки</li>
                        <?php else: ?>
                            <li>Проверьте правильность введенных данных</li>
                            <li>Убедитесь, что на вашем счете достаточно средств</li>
                            <li>Если проблема повторяется, свяжитесь с нашей службой поддержки</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="button-group">
                    <a <?= "id=\"" . htmlspecialchars($statusInfo['id']) . "\""; ?> href="#" class="btn primary-btn"><?= htmlspecialchars($statusInfo['buttonText']); ?></a>
                    <a href="/" class="btn secondary-btn">Вернуться на главную</a>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.getElementById('reloadBtn').addEventListener('click', function() {
            window.location.reload();
        });
        document.getElementById('cpBtn').addEventListener('click', function() {
            window.location.href = '/dashboard';
        });
    </script>
</body>
</html>
