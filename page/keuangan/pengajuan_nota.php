<?php include '../layouts/session_login.php' ?>
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
                <div class="content">
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Pengajuan Nota</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="pengajuan-nota" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nota</th>
                                            <th>Rekam Medis</th>
                                            <th>Nama Pasien</th>
                                            <th>Tanggal Pemeriksaan</th>
                                            <th>Total Tarif</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hasil-pengajuan-nota">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nota</th>
                                            <th>Rekam Medis</th>
                                            <th>Nama Pasien</th>
                                            <th>Tanggal Pemeriksaan</th>
                                            <th>Total Tarif</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'update_pengajuan_nota.php' ?>

    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <?php include '../layouts/format_rupiah.php' ?>

    <script src="../../js/keuangan.js"></script>
    <?php if($_SESSION['auth']['role'] == 'admin' || $_SESSION['auth']['role'] == 'karyawan'  ): ?>
    <script>
        getDataPengajuanNota() 
    </script>
    <?php endif; ?>
</body>

</html>