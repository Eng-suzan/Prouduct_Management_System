
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container px-4 px-lg-5">

<a class="navbar-brand" href="#">EraaSoft PMS</a>

<div class="collapse navbar-collapse">

<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

<li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
<li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
<li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>

<?php if(isset($_SESSION['user'])){?>
<li class="nav-item"><a class="nav-link" href="create_product.php">create</a></li>
<li class="nav-item">
<a class="nav-link" href="products_list.php">Products</a>


</li>

        <!-- زرار مباشر للـ Orders Dashboard -->
        <li class="nav-item">
          <a class="nav-link btn btn-sm btn-primary text-white ms-2" href="orders_dashboard.php">My Orders</a>
        </li> 
<li class="nav-item"><a class="nav-link" href="logout.php">logout</a></li>

             

<?php }else{ ?>
<li class="nav-item"><a class="nav-link" href="login.php">login</a></li>
<li class="nav-item"><a class="nav-link" href="register.php">register</a></li>
<?php }?>

<?php
// التأكد من وجود الكارت في السيشن
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<form class="d-flex" action="cart.php">
    <button class="btn btn-outline-dark" type="submit">
        <i class="bi-cart-fill me-1"></i>
        Cart
        <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $cart_count ?></span>
    </button></form>

</ul>

</div>
</div>
</nav>