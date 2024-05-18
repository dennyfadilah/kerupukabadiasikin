<?php

require 'config/config.php';
global $dir;

// Check if the user is already logged in
if (isset($_SESSION["login"])) {
    echo "<script>window.location.href = '$dir';</script>";
    exit;
}

// Check if the user submitted the login form
if (isset($_POST["login"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST['password'];
    loginCheck($username, $password);
}

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Hapus pesan kesalahan setelah ditampilkan
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Kerupuk Abadi Asikin | Login</title>

    <!-- Custom fonts for this template-->
    <link href="src/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="shortcut icon" href="src/assets/image/favicon.ico" type="image/x-icon">

    <!-- Custom styles for this template-->
    <link href="src/assets/css/sb-admin-2.min.css" rel="stylesheet">

<body>
    <div class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="col-md-5">
                    <div class="card o-hidden border-0 shadow-lg my-5">

                        <div class="card-header text-center">
                            <img src="src/assets/image/logo.png" alt="logo" width="100">
                            <h6 class="m-0 font-weight-bold text-primary">Kerupuk Abadi Asikin</h6>
                        </div>

                        <div class="card-body">
                            <!-- Nested Row within Card Body -->

                            <div class="p-3">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>

                                <?php if (isset($error_message)) : ?>
                                    <div class="alert alert-danger text-center" role="alert">
                                        <?= $error_message; ?>
                                    </div>
                                <?php endif; ?>

                                <form class="user py-2" method="post">

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" required />
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required />
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block" name="login">
                                        Login
                                    </button>
                                </form>

                                <hr class="my-3" />

                                <div class="text-center">
                                    <a class="small" href="<?= $dir ?>/register">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="src/assets/vendor/jquery/jquery.min.js"></script>
    <script src="src/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="src/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="src/assets/js/sb-admin-2.min.js"></script>
</body>

</html>