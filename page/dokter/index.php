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
                    <button type="button" class="btn btn-primary" data-toggle="modal" onclick="listSpesialis()" data-target="#exampleModalTambah">
                        Add Dokter
                    </button>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Data Master Dokter</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Spesialis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hasil">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <?php include_once('create.php') ?>
                    <?php include_once('update.php') ?>
                    <?php include_once('jadwal/index.php') ?>
                    <?php include_once('jadwal/create.php') ?>
                    <?php include_once('jadwal/update.php') ?>
                </div>
            </div>
        </div>
    </div>
    <?php include '../layouts/script.php' ?>
    <script src="../../js/dokter.js"></script>
    <script src="../../js/dokter_jadwal.js"></script>
</body>

</html>