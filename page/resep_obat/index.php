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
                    <?php if($_SESSION['auth']['role'] !== 'pasien' && $_SESSION['auth']['role'] !== 'perawat') : ?>
                    <a type="button" class="btn btn-primary" href="create.php">
                        Add Resep Obat
                    </a>
                    <?php endif; ?>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Data Resep Bawa Pulang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Rekam Medis</th>
                                            <th>Nama Pasien</th>
                                            <th>Tanggal Pemerikasaan</th>
                                            <th>Obat</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hasil">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No Rekam Medis</th>
                                            <th>Nama Pasien</th>
                                            <th>Tanggal Pemerikasaan</th>
                                            <th>Obat</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <?php include '../layouts/format_rupiah.php' ?>
    <script src="../../js/resep_obat.js"></script>
    <script>
        getData();
    </script>
</body>

</html>