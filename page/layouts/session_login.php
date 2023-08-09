<?php 
session_start(); 

if(!$_SESSION['auth']){
    header("location:../auth/login.php");
}

?>