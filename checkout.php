<?php
session_start();
require_once('inc/header.php');

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$totalPrice = 0;
?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Checkout</h1>
            <p class="lead fw-normal text-white-50 mb-0">Review your cart and place your order</p>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5">
            <!-- Cart Column -->
            <div class="col-12 col-lg-4 mb-4">
                <div class="border p-3">
                    <h4>Your Cart</h4>
                    <ul class="list-unstyled">
                        <?php if(count($cart) > 0): ?>
                            <?php foreach($cart as $id => $item): 
                                $lineTotal = $item['price'] * $item['quantity'];
                                $totalPrice += $lineTotal;
                            ?>
                            <li class="border p-2 my-1">
                                <?= htmlspecialchars($item['name']) ?> - 
                                <span class="text-success"><?= $item['quantity'] ?> x $<?= $item['price'] ?></span>
                                <br>
                                <small>Total: $<?= $lineTotal ?></small>
                            </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>Your cart is empty</li>
                        <?php endif; ?>
                    </ul>
                    <h5>Total Price: $<?= $totalPrice ?></h5>
                </div>
            </div>

            <!-- Form Column -->
            <div class="col-12 col-lg-8">
                <div class="border p-3">
                    <h4>Billing Details</h4>
                    <form action="process_checkout.php" method="POST">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="notes">Notes</label>
                            <input type="text" name="notes" id="notes" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Place Order" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>