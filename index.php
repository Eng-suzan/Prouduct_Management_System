        <?php
        session_start();
        require_once('inc/header.php');
        require_once('inc/nav.php');

        $file = "data/products.json";

        if (file_exists($file)) {
            $products = json_decode(file_get_contents($file), true);
            if (!$products) $products = [];
        } else {
            $products = [];
        }

        // رسالة الترحيب
        if (isset($_SESSION['user'])) {
            echo "<h2> Welcome " . htmlspecialchars($_SESSION['user']) . "</h2>";
        } else {
            echo "<h2>Welcome, Guest </h2>";
        }
        ?>

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">
                        With this shop homepage template
                    </p>
                </div>
            </div>
        </header>

        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">

                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                    <?php if (count($products) > 0): ?>

                        <?php foreach ($products as $key => $product): ?>
                            <?php

                            $image = isset($product['image']) && $product['image'] != "" ? $product['image'] : "images/default.png";

                            $name  = isset($product['name']) ? $product['name'] : "Unnamed Product";

                            $price = isset($product['price']) ? $product['price'] : 0;

                            $sale = isset($product['sale']) && $product['sale'];

                            $rating = isset($product['rating']) ? intval($product['rating']) : 0;

                            ?>

                            <div class="col mb-5">

                                <div class="card h-100">

                                    <?php if ($sale): ?>
                                        <div class="badge bg-dark text-white position-absolute" style="top:10px; right:10px;">
                                            Sale
                                        </div>
                                    <?php endif; ?>

                                    <img class="card-img-top" src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($name) ?>" />

                                    <div class="card-body p-4">

                                        <div class="text-center">

                                            <h5 class="fw-bolder"><?= htmlspecialchars($name) ?></h5>

                                            <!-- Rating -->
                                            <?php if ($rating > 0): ?>
                                                <div class="d-flex justify-content-center small text-warning mb-2">

                                                    <?php for ($i = 1; $i <= 5; $i++): ?>

                                                        <span><?= $i <= $rating ? '★' : '☆' ?></span>

                                                    <?php endfor; ?>

                                                </div>
                                            <?php endif; ?>

                                            <!-- Price -->

                                            <?php if ($sale):

                                                $newPrice = $price - ($price * 0.2); // خصم 20%

                                            ?>

                                                <span class="text-muted text-decoration-line-through">
                                                    $<?= htmlspecialchars($price) ?>
                                                </span>

                                                $<?= htmlspecialchars($newPrice) ?>

                                            <?php else: ?>

                                                $<?= htmlspecialchars($price) ?>

                                            <?php endif; ?>

                                        </div>

                                    </div>

                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            <a class="btn btn-outline-dark mt-auto" href="add_to_cart.php?id=<?= $key ?>">Add to cart</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <p class="text-center">No products available.</p>

                    <?php endif; ?>

                </div>

            </div>

        </section>

        <?php require_once('inc/footer.php'); ?>