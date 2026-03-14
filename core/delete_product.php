<?php
session_start();

$file = "../data/products.json";

if(isset($_GET['id'])){

$id = $_GET['id'];

$products = json_decode(file_get_contents($file), true);

if(isset($products[$id])){
unset($products[$id]);
}

$products = array_values($products);

file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));

$_SESSION['success'] = "Product deleted successfully";

header("Location: ../products_list.php");
exit();

}
?>