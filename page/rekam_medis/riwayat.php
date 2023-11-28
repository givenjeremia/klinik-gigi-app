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
                <input type="hidden" id="id_pasien" value="<?= str_replace(' ', '+', $_GET['data']) ?>">
                <input type="hidden" id="id_reservasi" value="<?=  str_replace(' ', '+', $_GET['reservasi'])?>">
                <input type="hidden" id="tanggal" value="<?=  str_replace(' ', '+', $_GET['tanggal']) ?>">
                <input type="hidden" id="dokter" value="<?=  str_replace(' ', '+', $_GET['dokter']) ?>">

                <h3>Riwayat Pemeriksaan Perawatan</h3>
                <div class="content">
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Detail Pasien</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Nama</th>
                                            <td id="nama_pasien"></td>
                                            <th>Tanggal Lahir</th>
                                            <td id="tanggal_lahir_pasien"></td>
                                        </tr>
                                        <tr>
                                            <th>No. Telepon</th>
                                            <td id="no_telepon_pasien"></td>
                                            <th>Alamat</th>
                                            <td id="alamat_pasien"></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td id="jenis_kelamin_pasien"></td>
                                            <th>Umur</th>
                                            <td id="umur_pasien"></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Rekam Medis</h3>
                            <div class="card-tools" id="card-tools-rekam-medis">
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalTambah">
                                    Tambah Rekam Medis
                                </button> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Pemeriksaan</th>
                                            <th>Keluhan</th>
                                            <th>Diagnosa</th>
                                            <th>Action</th>
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
    <?php include 'detail_riwayat.php' ?>
    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <?php include '../layouts/format_rupiah.php' ?>

    <script src="../../js/rekam_medis_riwayat.js"></script>
    <script>
        
    </script>
</body>

</html>