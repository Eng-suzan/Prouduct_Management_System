<?php
session_start();
require 'inc/header.php';
require 'inc/nav.php';
?>

<div class="container mt-4">
    <h2>Create Product</h2>

    <form action="core/create_product_validation.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Product Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price:</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description:</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
<div class="mb-3">
    <label for="image" class="form-label">Product Image URL:</label>
    <input type="text" id="image" name="image" class="form-control" required>
</div>

<label>Rating</label>
<input type="number" name="rating" min="0" max="5">

<label>Sale</label>
<select name="sale">
<option value="true">Yes</option>
<option value="false">No</option>
</select>
        <button type="submit" class="btn btn-primary">Create Product</button>

    </form>
</div>

<?php require 'inc/footer.php'; ?>