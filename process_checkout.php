<?php
session_start();

// 
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$phone = $_POST['phone'] ?? '';
$notes = $_POST['notes'] ?? '';


$cart = $_SESSION['cart'] ?? [];
if(empty($cart)){
    echo "Your cart is empty!";
    exit();
}

if(!isset($_SESSION['user_id'])){
    echo "Please login first!";
    exit();
}


$order = [
    'order_id' => time(), 
    'user_id' => $_SESSION['user_id'], 
    'customer' => [
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'phone' => $phone,
        'notes' => $notes
    ],
    'items' => $cart,
    'total' => array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0),
    'status' => 'Pending',
    'date' => date('Y-m-d H:i:s')
];


$file = "data/orders.json";
$orders = [];
if(file_exists($file)){
    $orders = json_decode(file_get_contents($file), true);
    if(!is_array($orders)) $orders = [];
}


$orders[] = $order;


file_put_contents($file, json_encode($orders, JSON_PRETTY_PRINT));

unset($_SESSION['cart']);


header("Location: orders_dashboard.php");
exit();