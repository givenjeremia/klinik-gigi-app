<?php 
$mysqli = new mysqli("localhost", "root", "", "klinik_gigi");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    die();
}

?>