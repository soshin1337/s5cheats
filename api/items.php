<?php
require_once '../core/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die(json_encode(['error' => 'Unauthorized']));
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT orders.order_id, orders.order_key, orders.order_amount, orders.order_date, 
    orders.product_id, orders.product_type, products.product_name, products.manual_url, products.loader_url
    FROM orders
    JOIN 
    products ON orders.product_id = products.product_id
    WHERE orders.owner_id = :userId
    ORDER BY orders.order_date DESC
");

$stmt->execute(['userId' => $userId]);

$items = [];    

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $item = [
        'orderId' => $row['order_id'],
        'name' => $row['product_name'],
        'price' => number_format($row['order_amount'], 2) . ' руб.',
        'key' => $row['order_key'],
        'purchaseDate' => date('d.m.Y', strtotime($row['order_date'])),
        'manualUrl' => $row['manual_url'],
        'loaderUrl' => $row['loader_url'],
        'productId' => $row['product_id'],
        'productType' => $row['product_type'],
    ];

    if($row['order_key'] == 'multiple'){
        $fileName = md5($row['order_id'] . ORDER_SALT) . ".txt";
        $item['keys_path'] = "orders/" . $fileName; 
    }

    $items[] = $item;
}

echo json_encode([
    'items' => $items,
    'totalItems' => count($items)   
]);
