<?php
session_start();
require 'inc/header.php';
require 'inc/nav.php';

$file = "data/products.json";

if(file_exists($file)){
    $products = json_decode(file_get_contents($file), true);
    if(!$products) $products = [];
} else {
    $products = [];
}

if(isset($_SESSION['success'])){
echo "<p style='color:green'>" . $_SESSION['success'] . "</p>";
unset($_SESSION['success']);}


?>

<div class="container mt-4">
    <h2>Products List</h2>

    <table class="table table-bordered">

        <thead>

            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
          
                <th>Product Image </th>
                  <th>Sale</th>
            <th>Rating</th>
            </tr>
        </thead>

        <tbody>
<?php if (!empty($products) && is_array($products)): ?>
    <?php 
$currentUser = $_SESSION['user_id'];

foreach ($products as $index => $product): 

if(isset($product['user_id']) && $product['user_id'] == $currentUser):
?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($product['name'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($product['price'] ?? '0') ?></td>
            <td><?= htmlspecialchars($product['description'] ?? '-') ?></td>
            <td>
                <a href="edit_product.php?id=<?= $index ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="core/delete_product.php?id=<?= $index ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
            <td>
                <img src="<?= htmlspecialchars($product['image'] ?? 'default.png') ?>" width="50" alt="Product Image">
            </td>
            <td><?= htmlspecialchars($product['sale'] ? 'Yes' : 'No') ?></td>

             <td><?= htmlspecialchars($product['rating'] ?? '0') ?> ⭐</td>

        </tr>
        <?php endif; endforeach; ?>
  
<?php else: ?>
    <tr>
        <td colspan="6">No products found</td>
    </tr>
<?php endif; ?>
      

        </tbody>
    </table>
</div>

<?php require 'inc/footer.php'; ?>