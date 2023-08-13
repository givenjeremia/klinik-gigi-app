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
                            <h3 class="card-title">Pengajuan Reservasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="pengajuan-reservasi" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokter</th>
                                            <?php if($_SESSION['auth']['role'] != 'pasien' ): ?>
                                            <th>Nama Pasien</th>
                                            <?php endif; ?>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Status</th>
                                            <!-- <?php if($_SESSION['auth']['role'] != 'pasien' ): ?>
                                            <th>Aksi</th>
                                            <?php endif; ?> -->
                                        </tr>
                                    </thead>
                                    <tbody id="hasil-pengajuan-reservasi">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokter</th>
                                            <?php if($_SESSION['auth']['role'] != 'pasien' ): ?>
                                            <th>Nama Pasien</th>
                                            <?php endif; ?>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Status</th>
                                            <!-- <?php if($_SESSION['auth']['role'] != 'pasien' ): ?>
                                            <th>Aksi</th>
                                            <?php endif; ?> -->
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
    <?php include '../layouts/script.php' ?>
    <script src="../../js/pengajuan.js"></script>
    <?php if($_SESSION['auth']['role'] == 'admin' ): ?>
    <script>
        getDataPengajuan()
    </script>
    <?php endif; ?>
</body>

</html>