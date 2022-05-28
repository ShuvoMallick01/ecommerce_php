<?php
    // session
    session_start();

    require_once "./partials/head.php";
    require_once "./partials/header.php";

    //helpers
    include_once "./helpers/get_url.php";
    require_once "./helpers/get_star.php";
    require_once "./helpers/db.php";
?>

<?php 
    // print_r($_SERVER);
    $products=[];
    $db= new DbController;
    $products= $db->getProducts();
    // print_r($products);
?>

<!-- Product list area -->
<section class="py-5 full-height">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Our Products</h3>
                <hr class="mb-5">
            </div>
        </div>

        <div class="row gx-md-5 gy-5">

            <?php foreach($products as $product): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/<?php echo $product['image'] ?>" class="card-img-top p-2" alt="product">
                    <div class="card-body">
                        <h5><a href="product.php?id=<?php echo $product['id'] ?>"
                                class="text-dark"><?php echo substr($product['name'],0,30) ?>...</a>
                        </h5>
                        <div class="my-2">
                            <?php get_star($product['rating']); ?>
                        </div>
                        <h4>$<?php echo $product['price'] ?></h4>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>

    </div>

</section>

<?php include_once "./partials/footer.php"?>