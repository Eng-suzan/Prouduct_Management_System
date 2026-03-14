<?php
session_start();

$file = "../data/products.json";

$products = json_decode(file_get_contents($file), true);

$id = $_POST['id'];

$products[$id]['name'] = $_POST['name'];
$products[$id]['price'] = $_POST['price'];
$products[$id]['description'] = $_POST['description'];
$products[$id]['image']=$_POST['image'];
$products[$id]['sale']=$_POST['sale'];
$products[$id]['rating']=$_POST['rating'];
file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));

$_SESSION['success'] = "Product updated successfully";

header("Location: ../products_list.php");
exit();
?>