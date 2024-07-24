<?php
// db_connect.php

define('ORDER_SALT', 'bebra_salt'); // соль для создания файлов с ордерами

$host = 'localhost';
$dbname = 's5cheats';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
