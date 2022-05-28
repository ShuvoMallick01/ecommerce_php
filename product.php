<?php
session_start();

require_once "./helpers/get_title.php";

// include patials layout
require_once "./partials/head.php";
require_once "./partials/header.php";

// db
include_once "./db.php";
include_once "./helpers/get_star.php";

// set title
set_title('Product - PHP E-Commerce Shop');
?>

<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/php_projects/ecommerce_php/" class="btn bg-light rounded-0">GO Back</a>
            </div>
        </div>
    </div>
</section>

<?php 
    if (isset($_POST['submit'])) {
        if (isset($_POST['quantity']) && isset($_GET['id'])) {
            $quantity = htmlentities($_POST['quantity']);
            $productId = htmlentities($_GET['id']);
            $cartItem = ['productId' => $productId, 'quantity' => $quantity];
    
            if (isset($_SESSION['cart'])) {
                array_push($_SESSION['cart'], $cartItem);
                header("Location: cart.php");
            } else {
                $_SESSION['cart'] = [$cartItem];
                header("Location: cart.php");
            }
        }
    
    }

?>


<?php foreach ($products as $product):
    if ($product['id'] == $_GET['id']):
    ?>

<form action="product.php?id=<?php echo $product['id'] ?>" method="POST">
    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img src="<?php echo $product['image'] ?>" class="p-1" alt="product">
                    </div>
                </div>

                <div class="col-md-6">
                    <h4><?php echo $product['name'] ?></h4>
                    <p><?php echo $product['description'] ?></p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 py-3">
                            <?php get_star($product['rating']); ?>
                            <span class="ps-2">(<?php echo $product['numReviews'] ?>)</span>
                        </li>
                        <li class="list-group-item px-0 py-3">Price: $599.99</li>
                        <li class="list-group-item px-0 py-3">Status: In Stock Available</li>
                        <li class="list-group-item px-0 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <span>Quantity:</span>

                                <select name="quantity" class="form-select w-25">
                                    <option value="1" selected>1</option>
                                    <?php for ($item = 2; $item <= $product['countInStock']; $item++): ?>
                                    <option value="<?php echo $item ?>" selected><?php echo $item ?></option>
                                    <?php endfor?>
                                </select>
                            </div>
                        </li>
                        <li class="list-group-item px-0 py-3">
                            <button type="submit" name="submit" class="btn btn-dark rounded-0 px-4">Add To Cart</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</form>


<?php
endif;
endforeach;
?>


<?php include_once "./partials/footer.php"?>