<?php include '../layouts/session_login.php' ?>
<?php
$user = $_SESSION['auth'];
if ($user['role'] == 'admin' || $user['role'] == 'karyawan') {
} else if ($user['role'] == 'dokter') {
    header("location:../home/dokter.php");
}else if ($user['role'] == 'perawat') {
    header("location:../home/perawat.php");
}
else {
    header("location:../home/pasien.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../layouts/head.php' ?>

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?php include '../layouts/navbar.php' ?>
        <div class="content-wrapper">
            <div class="container-fluid pr-5 pl-5 pt-3">
                <section class="content">

                    <div class="container-fluid">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>Hai, <?= $_SESSION['auth']['username'] ?></h3>
                                <p>And Login Sebagai, <?= $_SESSION['auth']['role'] ?></p>
                            </div>
                        </div>
                        <!-- Daftar Pasien Hari Ini -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>Daftar Pasien Reservasi Hari Ini</h3>
                                <div class="table-responsive">
                                    <table id="jadwal-pasien" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Antrian</th>
                                                <th>Dokter</th>
                                                <th>Nama Pasien</th>
                                                <th>Keluhan</th>
                                                <th>Jam Reservasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasil-jadwal-pasien">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>No Antrian</th>
                                                <th>Dokter</th>
                                                <th>Nama Pasien</th>
                                                <th>Keluhan</th>
                                                <th>Jam Reservasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Jadwal Dokter Hari Ini -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>Daftar Dokter Hari Ini</h3>
                                <div class="table-responsive">
                                    <table id="jadwal-dokter" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Dokter</th>
                                                <th>Jam</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasil-jadwal-dokter">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Dokter</th>
                                                <th>Jam</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                         <!-- Jadwal Layanan Hari Ini -->
                         <div class="small-box bg-lightblue">
                            <div class="inner">
                                <h3>Daftar Layanan Hari Ini</h3>
                                <div class="table-responsive">
                                    <table id="jadwal-layanan" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jenis</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasil-layanan">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jenis</th>
                                                <th>Harga</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
<script src="../../js/admin_dashboard.js"></script>
</body>

</html>