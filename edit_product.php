<?php
session_start();
require 'inc/header.php';
require 'inc/nav.php';

$file = "data/products.json";
$products = json_decode(file_get_contents($file), true);

$id = $_GET['id'];

$product = $products[$id];
?>

<div class="container mt-4">
<h2>Edit Product</h2>

<form action="core/update_product.php" method="POST">

<input type="hidden" name="id" value="<?= $id ?>">

<div class="mb-3">
<label class="form-label">Product Name</label>
<input type="text" name="name" class="form-control"
value="<?= htmlspecialchars($product['name']) ?>">
</div>

<div class="mb-3">
<label class="form-label">Price</label>
<input type="number" name="price" class="form-control"
value="<?= htmlspecialchars($product['price']) ?>">
</div>

<div class="mb-3">
<label class="form-label">Description</label>
<textarea name="description" class="form-control"><?= htmlspecialchars($product['description']) ?></textarea>
</div>
<div class="mb-3">
    <label for="image" class="form-label">Product Image URL:</label>
    <input type="text" id="image" name="image" class="form-control" required>
</div>
<button type="submit" class="btn btn-primary">
Update Product
</button>

</form>
</div>

<?php require 'inc/footer.php'; ?>