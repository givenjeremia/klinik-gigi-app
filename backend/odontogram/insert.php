<?php 
require_once('../config.php');
try {
    $stmt = $mysqli->prepare("INSERT INTO `odontogram`(`nomor_gigi`, `posisi`, `tanggal`, `rekam_medis_id`, `data_pasien_id`) VALUES (?,?,?,?,?)");
    $stmt->bind_param('sssii', $_POST['nomor_gigi'], $_POST['posisi'], $_POST['tanggal'], $_POST['rekam_medis'],$_POST['pasien']);
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