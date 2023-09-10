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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalTambah">
                        Add Catatan Keuangan
                    </button>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Data Catatan Keuangan</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="daftar-catatan-keuangan" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Keterangan</th>
                                            <th>Jumlah</th>
                                            <th>Jenis Transaksi</th>
                                            <th>Nota</th>
                                            <!-- <th>Aksi</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="hasil-catatan-keuangan">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Keterangan</th>
                                            <th>Jumlah</th>
                                            <th>Jenis Transaksi</th>
                                            <th>Nota</th>
                                            <!-- <th>Aksi</th> -->
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
    <?php include_once('create_catatan_keuangan.php') ?>
    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_rupiah.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <script>
        $(document).on('input', '.format-rupiah', function() {
            $(this).val(formatRupiah(this.value));
        })

    </script>
    <script src="../../js/keuangan.js"></script>
    <script>
        getDataCatatanKeuangan()
    </script>
</body>

</html>