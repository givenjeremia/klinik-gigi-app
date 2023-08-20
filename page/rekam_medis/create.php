<?php include '../layouts/session_login.php' ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <?php include '../layouts/head.php' ?>
</head>

<body class='hold-transition layout-top-nav'>
    <div class='wrapper'>
        <?php include '../layouts/navbar.php' ?>
        <div class='content-wrapper'>
            <div class='container-fluid pr-5 pl-5 pt-3'>
                <div class='content'>
                    <div class='card mt-2'>
                        <div class='card-header'>
                            <h3 class='card-title'>Buat Rekam Medis</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class='card-body'>
                            <form id='FormCreateRekamMedis'>
                                <div class='row'>
                                    <div class='col'>
                                        <div class='mb-3'>
                                            <label for='exampleInputPassword1' class='form-label'>Tanggal Pemeriksaan</label>
                                            <input type="date" name="tanggal_pemeriksaan" class="form-control">
                                        </div>
                                        <div class='mb-3'>
                                            <label for='exampleInputPassword1' class='form-label'>Reservasi</label>
                                            <select name='jenis_kelamin' class=' select2bs4 w-100' required>
                                                <option value=''>Pilih Reservasi</option>
                                                <option value='L'>Laki - Laki</option>
                                                <option value='P'>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='exampleInputPassword1' class='form-label'>Keluhan</label>
                                            <textarea name="keluhan" class="form-control"></textarea>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='exampleInputPassword1' class='form-label'>Diagnosa</label>
                                            <textarea name="diagnosa" class="form-control"></textarea>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='exampleInputPassword1' class='form-label'>Tindakan</label>
                                            <textarea name="diagnosa" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class='col'>
                                        <!-- Obat -->
                                        <div class='mb-3'>

                                            <div class="row">
                                                <div class=" col-6">
                                                    <label for='exampleInputPassword1' class='form-label'>Obat</label>
                                                    <select id="cboObat" class='select2bs4 w-100' required>
                                                        <option value=''>Pilih Obat</option>
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for='exampleInputPassword1' class='form-label'>Qty</label>
                                                    <input type="number" id="qty" class="form-control">
                                                </div>
                                                <div class="col-3">
                                                    <label for='exampleInputPassword1' class='form-label'>&nbsp;</label>
                                                    <button id="btn-tambah-obat" class="btn btn-primary d-block">Tambah Obat</button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class='mb-3'>
                                            <label for='exampleInputPassword1' class='form-label'>Tabel Obat</label>
                                            <div class="table-responsive">
                                                <table id="tableObat" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Qty</th>
                                                            <th>Harga</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableObatBody">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Alat -->
                                        <div class='mb-3'>
                                            <div class="row mb-1">
                                                <div class="col">
                                                    <label for='exampleInputPassword1' class='form-label'>Alat</label>
                                                    <select id="cboAlat" class='select2bs4 w-100' required>
                                                        <option value=''>Pilih Alat</option>
                                                        <option value='L'>Laki - Laki</option>
                                                        <option value='P'>Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for='exampleInputPassword1' class='form-label'>Pemakaian</label>
                                                    <input type="number" id="pemakaian" class=" form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for='exampleInputPassword1' class='form-label'>Keterangan</label>
                                                    <input type="text" id="keterangan" class="form-control">
                                                </div>
                                                <div class="col">
                                                    <label for='exampleInputPassword1' class='form-label'>&nbsp;</label>
                                                    <button id="btn-tambah-alat" class="btn btn-primary d-block">Tambah Alat</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='exampleInputPassword1' class='form-label'>Tabel Alat</label>
                                            <div class="table-responsive">
                                                <table id="tableObat" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Pemakaian</th>
                                                            <th>Harga</th>
                                                            <th>Keterangan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableAlatBody">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('create.php') ?>
    <?php include_once('update.php') ?>
    <?php include '../layouts/script.php' ?>
    <script src='../../js/perawat.js'></script>
</body>

</html>