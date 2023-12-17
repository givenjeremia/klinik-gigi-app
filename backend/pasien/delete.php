<?php 
require_once('../config.php');
$mysqli->begin_transaction();
try {
    $id = $_POST['id'];
    $stmt = $mysqli->prepare("DELETE data_pasien, users FROM data_pasien JOIN users ON data_pasien.user_id = users.id WHERE data_pasien.id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $mysqli->commit();
    echo json_encode(['status' => 'success']);
} catch (mysqli_sql_exception $e) {
    $mysqli->rollback();
    echo json_encode(['status' => 'failed', 'error' => $e->getMessage()]);
}
?>
