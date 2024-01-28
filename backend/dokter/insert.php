<?php
require_once('../config.php');
// Add User Table
try {
    // Set Role Dokter
    $role = 'dokter';
    // Query Untuk Menambahkan User Tabel
    $stmt_user = $mysqli->prepare("INSERT INTO `users`(`username`, `password`, `role`) VALUES (?,?,?)");
    $stmt_user->bind_param('sss', $_POST['username'], $_POST['password'], $role);
    $stmt_user->execute();
    // Cek apakah berhasil atau belum
    $user_check = $stmt_user->affected_rows;

    if ($user_check > 0) {
        // Lanjutan Jika Berhasil Menambahkan User

        // Dapatkan Id User Yang Baru
        $newUserId = $mysqli->insert_id;
        // cek Apakah dia termasuk spesialis umum atau tidak 
        if ($_POST['spesialis'] == 'umum') {
            $stmt = $mysqli->prepare("INSERT INTO `data_dokter`(`nama`, `alamat`, `no_telp`, `jenis_kelamin`, `user_id`) VALUES (?,?,?,?,?)");
            $stmt->bind_param('ssisi', $_POST['nama'], $_POST['alamat'], $_POST['no_telp'], $_POST['jenis_kelamin'], $newUserId);
            $stmt->execute();
        } else {
            $stmt = $mysqli->prepare("INSERT INTO `data_dokter`(`nama`, `alamat`, `no_telp`, `jenis_kelamin`,`spesialis_id`, `user_id`) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param('ssisii', $_POST['nama'], $_POST['alamat'], $_POST['no_telp'], $_POST['jenis_kelamin'], $_POST['spesialis'], $newUserId);
            $stmt->execute();
        }
        // Cek Apakah Berhasil
        $jumlah_yang_dieksekusi = $stmt->affected_rows;
        if ($jumlah_yang_dieksekusi > 0) {
            // Jika Berhasil Tampilkan Success dengan nama dokternya
            echo json_encode(['status' => 'success', 'nama' => $_POST['nama']]);
        } else {
            echo json_encode(['status' => 'failed']);
        }

        $stmt->close();
    } else {
        // Jika user perta terdaftar atau sudah terdaftar dengan username sama maka failed
        echo json_encode(['status' => 'failed']);
    }
} catch (mysqli_sql_exception $e) {
    echo json_encode(['status' => 'failed']);
}
