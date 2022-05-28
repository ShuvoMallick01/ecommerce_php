<?php 
    session_start();
    include_once "./helpers/get_title.php";
    set_title('Cart - eCommerce Shop');
    include_once "./db.php";

    $cartList=[];
    $totalAmount= 0;
    
    if(isset($_SESSION['cart'])){
        $cartList= $_SESSION['cart'];
    }

    if(isset($_GET['cartId'])){
        foreach($cartList as $key => $cartItem){
            if($cartItem['productId'] === $_GET['cartId']){
                unset($cartList[$key]);
                $_SESSION['cart']= $cartList;
                header('Location: cart.php');
            }
        }
    }
?>

<?php
    //layout
    include_once "./partials/head.php";
    include_once "./partials/header.php";
?>

<?php if(count($cartList) === 0): ?>
<section class="py-5 full-height d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-body d-flex align-items-center flex-column p-5">
                    <i class="bi bi-basket text-warning" style="font-size: 80px;"></i>
                    <h4 class="text-uppercase py-3">Your cart is empty</h4>
                    <a href="index.php" class="btn btn-dark rounded-0 px-5 mt-4">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if(count($cartList) > 0): ?>
<section class="my-5 full-height">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach($cartList as $cartitem): ?>
                <?php foreach($products as $product): ?>
                <?php if($cartitem['productId'] == $product['id']): 
                    $totalAmount += $cartitem['quantity'] * $product['price']; ?>

                <div class="card card-body mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <img src="<?php echo $product['image'] ?>" width="90px" alt="">
                        <h6><?php echo $product['name'] ?></h6>
                        <h6><?php echo $cartitem['quantity'] ?> X $<?php echo $product['price'] ?></h6>
                        <h6>$<?php echo $cartitem['quantity'] * $product['price'] ?></h6>
                        <a href="/php_projects/ecommerce_php/cart.php?cartId=<?php echo $product['id'] ?>"><i
                                class="bi bi-x-circle text-danger"></i></a>
                    </div>
                </div>

                <?php endif ?>
                <?php endforeach ?>
                <?php endforeach ?>
            </div>

            <div class="col-md-4">
                <div class="card card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="text-uppercase">Total Cart Item (10)</h5>
                        <h5 class="text-uppercase text-info">$1000</h5>
                    </div>
                    <a href="" class="btn btn-dark text-uppercase">Checkout Proceed</a>
                </div>
            </div>

        </div>
    </div>

</section>
<?php endif; ?>


<!-- Footer -->
<?php include_once "./partials/footer.php" ?>