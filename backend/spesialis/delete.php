<?php 
require_once('../config.php');
try {
    $id = $_POST['id'];
    $stmt = $mysqli->prepare("DELETE FROM `spesialis` WHERE `id`=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $check = $stmt->affected_rows;
    if ($check > 0) {
        echo json_encode(['status'=>'success']);
    } else {
        echo json_encode(['status' => 'failed']);
    }
} catch (mysqli_sql_exception $e) {
    echo json_encode(['status' => 'failed','error' => $e->getMessage()]);
}
?>