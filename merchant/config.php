<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

define( 'S_PATH', __DIR__ . '/' );
// define( '__WORK_DIR__', '/' . 'payments' );

// /**
//  * Как Принимать платежи с карт
//  * Может быть 2 значения. Укажите одно из подходящих
//  * yoomoney - Через yoomoney
//  * qiwi - Через qiwi
//  */
// define('__CARD_METHOD__', 'yoomoney');

// /**
//  * Кошелёк YooMany
// */
// define( '__YOOMANY__', [
//     'yoo_wallet'        =>'4100111343299606'
// ]);

// /**
//  * Настройка для lava.ru
//  */
// define( '__LAVA__', [
//     'lava_id'           =>'', // Идентификатор проекта
//     'lava_secret_key'   => '', // Секретный ключ
//     'dop_key'           => '' // Дополнительный ключ
// ]);


// /**
//  * Настройка для freekassa.ru
//  */
// define( '__FREEKASSA__', [
//     'shopId'        => '52873', // Идентификатор проекта
//     'api'           => 'e1fe1bdbda1ef5c90f56f9202a1c8cfc', // Секретный ключ
//     'sc1'           => 'e8?)uDjJ?f?Z{jF', // Дополнительный ключ
//     'sc2'           => '36JHDlRbL[^y_dD' // Дополнительный ключ
// ]);

# AnyPay

define( '__ANYPAY__', [
    'apiKey' =>'',
    'apiId' => '',
    'projectId'  => 15071
]);
# log
define('__LOG__', false);