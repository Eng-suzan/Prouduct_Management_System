<?php
session_start();
require_once('inc/header.php');
//لوموجوده حطها فالكارت م موجوده حطها ف اراي فاضيه
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$totalPrice = 0;
?>

<div class="container my-5">
<h2>Your Cart</h2>
<table class="table table-bordered">
<thead>
<tr>
<th>#</th>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
<th>Delete</th>
</tr>
</thead>
<tbody>
<?php

$count = 1;
if(count($cart) > 0):
    foreach($cart as $id => $item):
        $lineTotal = $item['price'] * $item['quantity'];
        $totalPrice += $lineTotal;
?>
<tr>      
<th><?= $count++ ?></th>
<td><?= htmlspecialchars($item['name']) ?></td>
<td>$<?= $item['price'] ?></td>
<td><?= $item['quantity'] ?></td>
<td>$<?= $lineTotal ?></td>
<td><a href="delete_from_cart.php?id=<?= $id ?>" class="btn btn-danger">Delete</a></td>
</tr>
<?php
    endforeach;
else:
?>
<tr><td colspan="6" class="text-center">Your cart is empty</td></tr>
<?php endif; ?>
<tr>
<td colspan="2">Total Price</td>
<td colspan="3">$<?= $totalPrice ?></td>
<td><a href="checkout.php" class="btn btn-primary">Checkout</a></td>
</tr>
</tbody>
</table>
<a href="index.php" class="btn btn-secondary">Continue Shopping</a>
</div>

<?php require_once('inc/footer.php'); ?>