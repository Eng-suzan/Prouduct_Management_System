<?php
session_start();
require_once('inc/header.php');
require_once('inc/nav.php');

if(!isset($_SESSION['user_id'])){
    echo "<p>Please login first.</p>";
    exit;
}

$currentUserId = $_SESSION['user_id'];
$file = "data/orders.json";
$orders = [];
if(file_exists($file)){
    $orders = json_decode(file_get_contents($file), true);
    if(!is_array($orders)) $orders = [];
}

$userOrders = array_filter($orders, fn($o) => $o['user_id'] === $currentUserId);

$totalOrders = count($userOrders);
$totalSpent = array_sum(array_map(fn($o)=>$o['total'], $userOrders));
$pendingOrders = count(array_filter($userOrders, fn($o)=>$o['status']==='Pending'));
?>

<div class="container mt-5">
    <h2>My Orders Dashboard</h2>

    <div class="row my-4">
        <div class="col-md-4"><div class="card text-white bg-info mb-3 p-3">Total Orders: <?= $totalOrders ?></div></div>
        <div class="col-md-4"><div class="card text-white bg-success mb-3 p-3">Total Spent: $<?= $totalSpent ?></div></div>
        <div class="col-md-4"><div class="card text-white bg-warning mb-3 p-3">Pending Orders: <?= $pendingOrders ?></div></div>
    </div>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Order ID</th>
                <th>Products</th>
                <th>Total ($)</th>
                <th>Status</th>
                <th>Date</th>
                  <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($userOrders as $index => $order): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($order['order_id']) ?></td>
                <td>
                    <ul>
                        <?php foreach($order['items'] as $prod): ?>
                        <li><?= htmlspecialchars($prod['name']) ?> x <?= $prod['quantity'] ?> ($<?= $prod['price'] ?>)</li>
                        <?php endforeach; ?>
                    </ul>
                </td>
                <td><?= htmlspecialchars($order['total']) ?></td>
                <td><?= htmlspecialchars($order['status']) ?></td>
                <td><?= htmlspecialchars($order['date']) ?></td>
           <td>
<a href="core/delete_order.php?id=<?= $order['order_id'] ?>" 
class="btn btn-danger btn-sm">Delete</a>
</td>
            </tr>
            <?php endforeach; ?>
           
        </tbody> </table>
         <a href="index.php" class="btn btn-primary mt-3">Continue Shopping</a>
       

</div>