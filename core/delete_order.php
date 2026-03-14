<?php
session_start();

$file = "../data/orders.json";

if(!isset($_GET['id'])){
    header("Location: ../orders_dashboard.php");
    exit;
}

$orderId = $_GET['id'];

if(file_exists($file)){
    $orders = json_decode(file_get_contents($file), true);
    if(!$orders) $orders = [];
}else{
    $orders = [];
}

$orders = array_filter($orders, function($order) use ($orderId){
    return $order['order_id'] != $orderId;
});

file_put_contents($file, json_encode(array_values($orders), JSON_PRETTY_PRINT));

header("Location: ../orders_dashboard.php");
exit;
?>