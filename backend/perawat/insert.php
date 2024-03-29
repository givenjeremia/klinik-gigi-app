<?php 
require_once('../config.php');
try {
    $role = 'perawat';
    $stmt_user = $mysqli->prepare("INSERT INTO `users`(`username`, `password`, `role`) VALUES (?,?,?)");
    $stmt_user->bind_param('sss', $_POST['username'], $_POST['password'], $role);
    $stmt_user->execute();
    $user_check = $stmt_user->affected_rows;

    if ($user_check > 0) {
        $newUserId = $mysqli->insert_id;
        $stmt = $mysqli->prepare("INSERT INTO `data_perawat`(`nama`, `alamat`, `no_telp`, `user_id`) VALUES (?,?,?,?)");
        $stmt->bind_param('sssi',$_POST['nama'],$_POST['alamat'],$_POST['no_telp'],$newUserId);
        $stmt->execute();
        $jumlah_yang_dieksekusi = $stmt->affected_rows;
        if($jumlah_yang_dieksekusi > 0){
            echo json_encode(['status'=>'success','nama'=>$_POST['nama']]);
        }
        else{
            echo json_encode(['status'=>'failed']);
        }
    } else {
        echo json_encode(['status' => 'failed']);
    }
} catch (mysqli_sql_exception $e) {
    echo json_encode(['status' => 'failed','error' => $e->getMessage()]);
}
?>