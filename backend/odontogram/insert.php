<?php 
require_once('../config.php');
try {
    $tanggal = date('Y-m-d');
    $stmt = $mysqli->prepare("INSERT INTO `odontogram`(`nomor_gigi`, `posisi`, `tanggal`, `rekam_medis_id`, `data_pasien_id`,`status`,`color`) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param('sssiiss', $_POST['nomor_gigi'], $_POST['posisi'], $tanggal, $_POST['rekam_medis'],$_POST['pasien'],$_POST['status'],$_POST['color']);
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