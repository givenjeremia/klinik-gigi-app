<?php 
require_once( '../config.php' );
try {
    $id = $_POST['id'];
    // Update Status Kehadiran
    $status = $_POST['status'];
    $stmt = $mysqli->prepare('UPDATE `reservasi_kllinik` SET `status_kehadiran`=? WHERE `id`=?');
    $stmt->bind_param('si',$status,$id);
    $stmt->execute();
    $eksekusi = $stmt->affected_rows;
    if ($eksekusi > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'failed']);
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => 'failed','error' => $th->getMessage()]);
}

?>