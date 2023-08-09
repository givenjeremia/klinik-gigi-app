<?php 
session_start();
if($_SESSION['auth']){
    header("Location: page/home/index.php");
}
else{
    header("Location: page/auth/login.php");
}

?>