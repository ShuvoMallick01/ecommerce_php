<?php require_once 'helpers/db.php' ?>
<?php 
    $user= null;
    $totalCartitem=0;

    if(isset($_SESSION['cart'])){
        $totalCartitem= count($_SESSION['cart']);
        // print_r($_SESSION['cart']);
    }

    if(isset($_SESSION['user'])):
        try{
            $db= new DbController();
            $user= $db->getCurrentUser($_SESSION['user']);
        } catch(Exception $error){
            echo $error->getMessage();
        }
    endif;
    
?>

<header class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">PHP SHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/php_projects/ecommerce_php">Home</a>
                    </li>

                    <?php if(!$user): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart (<?php echo $totalCartitem ?>)</a>
                    </li>

                    <?php if($user): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                    <li class="nav-item">
                        <p class="nav-link"><?php echo $user['name']; ?></p>
                    </li>
                    <?php endif;?>

                </ul>
            </div>
        </div>
    </nav>
</header>