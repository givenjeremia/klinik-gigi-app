<?php 
require_once('../config.php');
$hari_list = [
    'Sunday'=> 'Minggu',
    'Monday' => 'Senin',
    'Tuesday'=> 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
];
session_start();

// die();
try {
    // Cek Date
    $jadwal = $_POST['jadwal'];
    $hari = $_POST['hari'];
    $tanggal = $_POST['tanggal'];
    // Cek Jadwal Kuota
    $sql_jadwal = 'SELECT * FROM `jadwal_dokter` WHERE `id`=?';
    $stmt_jadwal = $mysqli->prepare($sql_jadwal);
    $stmt_jadwal->bind_param('i',$jadwal);
    $stmt_jadwal->execute();
    $result_jadwal = $stmt_jadwal->get_result();
    $data_jadwal = $result_jadwal->fetch_assoc();
    $kuota_pasien = $data_jadwal['kuota_pasien'];
    // Hari By tanggal
    $hari_by_tanggal = $day_now = date("l",strtotime($tanggal));
    if ($hari_list[$hari_by_tanggal] == $hari  && $kuota_pasien > 0) {
        // Get Data Pasien By Auth 
        $id_pasien = 0;
        if($_SESSION['auth']['role'] == 'pasien'){
            $id_user = $_SESSION['auth']['id'];
            $stmt_pasien = $mysqli->prepare('SELECT * FROM `data_pasien` WHERE `user_id` =?');
            $stmt_pasien->bind_param('i',$id_user);
            $stmt_pasien->execute();
            $result_pasien = $stmt_pasien->get_result();
            $data_pasien = $result_pasien->fetch_assoc();
            $id_pasien = $data_pasien['id'];
        }
        else{
            $id_pasien = $_POST['pasien'];
        }
        // Cek Jika Sudah Reservasi Di tanggal yang sama
        $sql_cek = "SELECT count(id) as Pernah FROM `reservasi_kllinik` WHERE `tanggal_reservasi`= ? AND `jadwal_dokter_id`= ? AND `data_pasien_id_pasien` = ? AND `status` != 'rejected'";
        $stmt_cek = $mysqli->prepare($sql_cek);
        $stmt_cek->bind_param('sii',$tanggal,$jadwal,$id_pasien);
        $stmt_cek->execute();
        $result_cek= $stmt_cek->get_result();
        $data_cek = $result_cek->fetch_assoc();
        $pernah = $data_cek['Pernah'];
        if($pernah != 1){
            if(!isset($_POST['keluhan'])){
                echo json_encode(['status' => 'failed','msg' => 'Harap Pilih Keluhan']);
                die();
            }
            // Get No Antrian
            $now_date_with_time = date('Y-m-d H:i:s');
            $now_date= date('Y-m-d');
            $stmt_antrian = $mysqli->prepare('SELECT MAX(`no_antrian`)+1 as NoAntrian FROM `reservasi_kllinik` WHERE `tanggal_reservasi`=? AND `jadwal_dokter_id`=?');
            $stmt_antrian->bind_param('si',$tanggal,$jadwal);
            $stmt_antrian->execute();
            $result_antrian = $stmt_antrian->get_result();
            $data_antrian = $result_antrian->fetch_assoc();
            $no_antrian = 1;
            if ($data_antrian['NoAntrian']!= null) {
                $no_antrian = $data_antrian['NoAntrian'];
            }
           
            // Data Jdwal
            $stmt_jadwal = $mysqli->prepare('SELECT * FROM `jadwal_dokter` WHERE `id` =?');
            $stmt_jadwal->bind_param('i',$jadwal);
            $stmt_jadwal->execute();
            $result_jadwal = $stmt_jadwal->get_result();
            $data_jadwal = $result_jadwal->fetch_assoc();
             // Get jam
             $originalTime = strtotime('2000-01-01 ' . $data_jadwal['jam']);
             $menit_tambah = 0;
             if ($no_antrian != 1) {
                $menit_tambah = ($no_antrian -1) * 30;
                $originalTime += $menit_tambah * 60;
            }
            $newTime = date('H:i:s', $originalTime);
            // Add Reservasi
            $status = 'pending';
            $stmt = $mysqli->prepare("INSERT INTO `reservasi_kllinik`(`no_antrian`, `tanggal_input_reservasi`, `tanggal_reservasi`, `jam_reservasi`, `status`, `jadwal_dokter_id`,`data_pasien_id_pasien`,`keluhan_baru`) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param('issssiis', $no_antrian,$now_date_with_time,$tanggal,$newTime ,$status,$jadwal,$id_pasien,$_POST['keluhan_baru']);
            $stmt->execute();
            $jumlah_yang_dieksekusi = $stmt->affected_rows;
            if ($jumlah_yang_dieksekusi > 0) {
                // get id
                $id_reservasi = $stmt->insert_id;
                $keluhan = $_POST['keluhan'];
                foreach ($keluhan as $key => $value) {
                    $stmt = $mysqli->prepare("INSERT INTO `keluhan_reservasi`(`keluhan_id`, `reservasi_id`) VALUES (?,?)");
                    $stmt->bind_param('ii', $value,$id_reservasi);
                    $stmt->execute();
                }
                echo json_encode(['status' => 'success','msg'=>'Berhasil Tambah Reservasi']);
            } else {
                echo json_encode(['status' => 'failed','msg' => 'Gagal Tambah Reservasi']);
            }
            $stmt->close();

        }
        else{
            echo json_encode(['status' => 'failed','msg' => 'Gagal Tambah Reservasi, Anda Pernah Mendaftar Di Tanggal Yang Sama Dan Belum Di Tolak']);
        }
    }
    else{
        echo json_encode(['status' => 'failed','msg' => 'Harap Masukan Tanggal Sesuai Hari / Kuota Pasien Sudah Habis']);
    }


    
} catch (\Throwable $th) {
    //throw $th;
    echo json_encode(['status' => 'failed','msg' => $th->getMessage()]);
}


?>