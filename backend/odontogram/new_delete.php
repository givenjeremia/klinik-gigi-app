<?php 
require_once('../config.php');
try {
    $odontogram = $_POST['odontogram'];
    $stmt = $mysqli->prepare("DELETE FROM `new_odontogram` WHERE `id`=?");
    $stmt->bind_param('i', $odontogram);
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