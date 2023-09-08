<?php
session_start();
if (isset($_SESSION['auth'])) {
    if ($_SESSION['auth']['role'] == 'pasien') {
        header('Location: ../home/pasien.php');
    } else {
        header('Location: ../home/index.php');
    }
}

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <?php include '../layouts/head.php' ?>
</head>

<body class='hold-transition login-page'>
    <div class='login-box'>
        <div class='login-logo'>
            <a href='/'><b>Klinik</b>GIGI</a>
        </div>
        <!-- /.login-logo -->
        <div class='card'>
            <div class='card-body login-card-body'>
                <p class='login-box-msg'>Silahkan Login Terlebih Dahulu</p>
                <form id='LoginPageForm' method='post'>
                    <div class='input-group mb-3'>
                        <input type='text' name='username' class='form-control' placeholder='Username'>
                        <div class='input-group-append'>
                            <div class='input-group-text'>
                                <span class='fas fa-user'></span>
                            </div>
                        </div>
                    </div>
                    <div class='input-group mb-3'>
                        <input type='password' name='password' class='form-control' placeholder='Password' require>
                        <div class='input-group-append'>
                            <div class='input-group-text'>
                                <span class='fas fa-lock'></span>
                            </div>
                        </div>
                    </div>
                    <button id='btn-login' type='submit' class='btn btn-primary btn-block'>Login</button>
                </form>
                <div class='row mt-1'>
                    <div class='col-auto'>
                        Belum Punya Akun ?
                    </div>
                    <div class='col-auto'>
                        <a href='#' data-toggle='modal' data-target='#exampleModalTambah'>Register</a>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('register.php') ?>
        <?php include '../layouts/script.php' ?>
        <script src='../../js/login.js'></script>
        <script src='../../js/register.js'></script>

</body>

</html>