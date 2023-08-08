<?php 
$mysqli = new mysqli("localhost", "root", "root", "klinik_gigi",8889);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    die();
}

?>