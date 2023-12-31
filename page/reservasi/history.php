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
                            <h3 class="card-title">History Reservasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="history-reservasi" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokter</th>
                                            <th>No Antrian</th>
                                            <?php if($_SESSION['auth']['role'] != 'pasien' ): ?>
                                            <th>Nama Pasien</th>
                                            <?php endif; ?>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Status Reservasi</th>
                                            <th>Status Kehadiran</th>
                                            <!-- <th>Aksi</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="hasil-reservasi">

                                    </tbody>
                                
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <script src="../../js/pasien_user.js"></script>
    <?php if($_SESSION['auth']['role'] == 'pasien' ): ?>
    <script>
        getDataHistoryByUser()
    </script>
    <?php endif; ?>
    <?php if($_SESSION['auth']['role'] == 'admin' || $_SESSION['auth']['role'] == 'karyawan' || $_SESSION['auth']['role'] == 'dokter'  ): ?>
    <script>
        getAllData()
        // getDataPasien()
    </script>
    <?php endif; ?>
    
</body>

</html>