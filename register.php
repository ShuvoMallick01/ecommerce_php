<?php 
    session_start();
    // require
    require_once 'helpers/check_user_session.php';
    require_once './helpers/get_title.php';
    require_once './helpers/get_url.php';
    require_once './helpers/db.php';
    require_once './partials/head.php';
    require_once './partials/header.php';
    set_title('Register-PHP ECommerce Shope');
?>

<?php 
    $nameError= null;
    $emailError= null;
    $passwordError= null;
    $connectionError= null;
    
    if(isset($_POST['submit'])){
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
            try{
                $name= htmlentities($_POST['name']);
                $email= htmlentities($_POST['email']);
                $password= htmlentities($_POST['password']);

                if(empty($name)){
                    $nameError= 'Name is required!';
                }
                if(empty($email)){
                    $emailError= 'Email is required!';
                }
                if(empty($password)){
                    $passwordError= 'Password is required!';
                }
                
                if(!empty($name) && !empty($email) && !empty($password)){
                    $db= new DbController();
                    $db->register($name, $email, $password);
                    header('Location: login.php');
                }
            }
            catch(Exception $error){
                $connectionError= $error->getMessage();
            }
        }
    }

?>

<section class="py-5 full-height d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-body p-5 shadow">
                    <h3>Register with Email</h3>
                    <hr class="mb-5">

                    <?php if (isset($connectionError)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $connectionError; ?>
                    </div>
                    <?php endif;?>

                    <form action="register.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" class="form-control" id="name" name="name">
                            <p class="text-danger"><?php echo $nameError; ?></p>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <p class="text-danger"><?php echo $emailError; ?></p>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <p class="text-danger"><?php echo $passwordError; ?></p>
                        </div>
                        <button type="submit" name="submit" class="btn btn-dark rounded-0 mt-3">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include_once "./partials/footer.php"?>