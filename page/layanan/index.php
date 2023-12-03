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
                    <?php if($_SESSION['auth']['role'] !== 'pasien') : ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" onclick="listSpesialis()" data-target="#exampleModalTambah">
                        Add Layanan
                    </button>
                    <?php endif; ?>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Layanan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Harga</th>
                                            <!-- <th>Hari</th> -->
                                            <th>Spesialis</th>
                                            <?php if($_SESSION['auth']['role'] !== 'pasien') : ?>
                                            <th>Aksi</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody id="hasil">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('create.php') ?>
    <?php include_once('update.php') ?>
    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_rupiah.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <script>
        $(document).on('input', '.format-rupiah', function() {
            $(this).val(formatRupiah(this.value));
        })
    </script>
    <script src="../../js/layanan.js"></script>
</body>

</html>