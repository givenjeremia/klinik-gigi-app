<?php 
try {
    session_start();
    unset($_SESSION['auth']);
    echo json_encode(['status'=>'success']);
} catch (\Throwable $th) {
    //throw $th;
    echo json_encode(['status'=>'error','error'=>$th->getMessage()]);
}
?>