<?php 
session_start();
if($_SESSION['auth']){
    $user = $_SESSION['auth'];
    if($user['role'] == 'admin' || $user['role'] == 'karyawan'){
        header("location: page/home/index.php");
    }
    else if($user['role'] == 'dokter') {
        header("location: page/home/dokter.php");
    }
    else{
        header("location: page/home/pasien.php");
    }
}
else{
    header("Location: page/auth/login.php");
}

?>