<?php
session_start();

require_once "helpers/check_user_session.php";
require_once "helpers/db.php";
require_once "./helpers/get_title.php";

// include patials layout
include_once "./partials/head.php";
include_once "./partials/header.php";

// set title
set_title('Login - PHP E-Commerce Shop');
?>

<?php 
    $emailError = null;
    $passwordError = null;
    $connectionError = null;

    if (isset($_POST['submit'])) {
        if (isset($_POST['email']) && isset($_POST['password'])) {

            try {
                $email = htmlentities($_POST['email']);
                $password = htmlentities($_POST['password']);

                if (empty($email)) {
                    $emailError = 'Email is required!';
                }
                if (empty($password)) {
                    $passwordError = 'Password is required!';
                }

                if (!empty($email) && !empty($password)) {
                    $db = new DbController();
                    $user = $db->login($email, $password);
                    $_SESSION['user'] = $user['id'];
                    header('Location: index.php');
                }

            } catch (Exception $error) {
                $connectionError = $error->getMessage();
            }

        }
    }
    
?>

<!-- Login Page -->
<section class="py-5 full-height d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-body p-5 shadow">
                    <h3>Login with Email</h3>
                    <hr class="mb-5">

                    <?php if (isset($connectionError)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $connectionError; ?>
                    </div>
                    <?php endif;?>


                    <form accept="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control rounded-0" id="email" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control rounded-0" id="password" name="password">
                        </div>
                        <button type="submit" name="submit" class="btn btn-dark rounded-0 mt-3">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include_once "./partials/footer.php" ?>