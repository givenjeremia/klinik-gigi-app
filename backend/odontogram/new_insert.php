<?php 
require_once('../config.php');
try {
    $tanggal = date('Y-m-d');
    $stmt = $mysqli->prepare("INSERT INTO `new_odontogram`(`nomor_gigi`, `posisi`, `tanggal`, `rekam_medis_id`, `action_odontogram_id`) VALUES (?,?,?,?,?)");
    $stmt->bind_param('sssii', $_POST['nomor_gigi'], $_POST['posisi'], $tanggal, $_POST['rekam_medis_id'],$_POST['action_odontogram_id']);
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