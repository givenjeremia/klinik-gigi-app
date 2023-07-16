<?php 
require_once('../config.php');

$username = $_POST['username'];
$password = $_POST['password'];
$stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `username`=? AND `password` =?");
$stmt->bind_param('ss',$username,$password);
$stmt->execute();
$datas = [];
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($row > 0){
    // Create Session
    // $_SESSION['auth'] = $row;
    echo json_encode(['status'=>'success', 'data'=>$row]);
}
else{

    echo json_encode(['status'=>'failed']);
}

?>