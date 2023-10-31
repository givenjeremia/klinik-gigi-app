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
                    <button type="button" onclick="formAddData()" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalTambah">
                        Add Odontogram
                    </button>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Data Odontogram</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>ID Rekam Medis</th>
                                            <th>Nama Pasien</th>
                                            <th>Nomor Gigi</th>
                                            <th>Posisi</th>
                                            <!-- <th>Aksi</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="hasil">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
               
                </div>
            </div>
        </div>
    </div>
    <?php include_once('create.php') ?>
    <?php include_once('update.php') ?>
    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>

    <script src="../../js/odontogram.js"></script>
</body>

</html>