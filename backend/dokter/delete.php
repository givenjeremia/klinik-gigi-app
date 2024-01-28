<?php 
require_once('../config.php');
try {
    // Get Data
    $id = $_POST['id'];
    // Query Data
    $stmt = $mysqli->prepare("DELETE FROM `data_dokter` WHERE `id`=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $check = $stmt->affected_rows;
    // Cek Jika Hapus Berhasil Yang Berarti Query Berhasil Dijalankan
    if ($check > 0) {
        // JIka Berhasil
        echo json_encode(['status'=>'success']);
    } else {
        // Jika Gagal
        echo json_encode(['status' => 'failed']);
    }
} catch (mysqli_sql_exception $e) {
    echo json_encode(['status' => 'failed','error' => $e->getMessage()]);
}
?>