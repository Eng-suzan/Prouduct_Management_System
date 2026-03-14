<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
     $image = trim($_POST['image']);
     $sale=trim($_POST['sale']);
     $rating=trim($_POST['rating']);

    if(empty($name) || empty($price) || empty($description)||empty($image)){
        echo "All fields are required!";
        exit();
    }
if($rating < 0 || $rating > 5){
  echo "Rating must be between 0 and 5";
exit();
}
    $file = "../data/products.json"; 

    
    if(file_exists($file)){
        $products = json_decode(file_get_contents($file), true);
        if(!$products)
             $products = [];
    } else {
        $products = [];
    }
    $currentUserId = $_SESSION['user_id'];
 $userProducts = array_filter($products, function($p) use ($currentUserId){
        return isset($p['user_id']) && $p['user_id'] == $currentUserId;
    });
    $newId = 1;
    if(!empty($userProducts)){
        $ids = array_column($userProducts, 'id');
        if(!empty($ids)){
            $newId = max($ids) + 1;
        }
    }

    $products[] = [
        "id" => $newId,
        "user_id" => $_SESSION['user_id'],
        "name" => $name,
        "price" => $price,
        "description" => $description,
        'image' => $image,
        'sale'=>$sale,
        'rating'=>$rating
         
    ];

    file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));

    $_SESSION['success'] = "Product created successfully!";
    header("Location: ../products_list.php");
    exit();
}
?>