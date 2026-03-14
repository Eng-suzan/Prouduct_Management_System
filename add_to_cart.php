<?php
session_start();

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']); //intval =>تحول اي قيمه لرقم صحيح

$products = json_decode(file_get_contents('data/products.json'), true);

if(!isset($products[$id])){
    header("Location: index.php");
    exit();
}

if(!isset($_SESSION['cart'])){

//لو المستخدم لسه ما عندوش سلة  
    $_SESSION['cart'] = [];//هننشئ واحدة فاضية
}


if(isset($_SESSION['cart'][$id])){//هل المنتج موجود بالفعل في السلة
    $_SESSION['cart'][$id]['quantity'] ++; //زود كميتو
}else{
    $_SESSION['cart'][$id] = [
        'name' => $products[$id]['name'],
        'price' => $products[$id]['price'],
        'quantity' => 1 //لو مش موجود ضيفه والكميه هتبق1
    ];
}

// 
header("Location: index.php");
exit();
?>