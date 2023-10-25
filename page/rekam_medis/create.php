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
                            
                            <div class="row">
                                <?php if (isset($_GET['namaDokter'])) : ?>
                                <div class="col">
                                    Nama Dokter : <?= $_GET['namaDokter']  ?>
                                </div>
                                <?php endif; ?>
                                <?php if (isset($_GET['tanggal']) && isset($_GET['jam'])) : ?>
                                <div class="col">
                                    Tanggal / Waktu : <?= $_GET['tanggal'].' / '.$_GET['jam']    ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- <div class='mb-3'>
                                <label for='exampleInputPassword1' class='form-label'>Tanggal Pemeriksaan</label>
                                <input type="date" name="tanggal_pemeriksaan" class="form-control">
                            </div> -->
                            <!-- <div class='mb-3'>
                                <label for='exampleInputPassword1' class='form-label'>Layanan</label>
                                <select id="cboLayanan" name='layanan' class=' select2bs4 w-100' required>
                                </select>
                            </div> -->
                            <form id='FormCreateRekamMedis'>
                                <?php if (isset($_GET['reservasi']) && isset($_GET['dokter'])) : ?>
                                    <input type="hidden" name="reservasi" value="<?= $_GET['reservasi'] ?>">
                                    <input type="hidden" name="jadwal_dokter_id" value="<?= $_GET['dokter'] ?>">
                                <?php else : ?>
                                    <div class='mb-3'>
                                        <label for='exampleInputPassword1' class='form-label'>Reservasi</label>
                                        <select id="cboReservasi" name='reservasi' class=' select2bs4 w-100' required>
                                        </select>
                                        <input type="hidden" name="jadwal_dokter_id" id="jadwal_dokter_id">
                                    </div>
                                <?php endif; ?>
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
                                    <textarea name="tindakan" class="form-control"></textarea>
                                </div>
                                <div class='mb-3'>
                                    <label for='exampleInputPassword1' class='form-label'>Biaya Tindakan</label>
                                    <input type="text" class="form-control format-rupiah" name="biaya_tindakan" id="biaya_tindakan">
                                </div>
                                <div class='mb-3'>
                                    <div class="row mb-1">
                                        <div class="col">
                                            <label for='exampleInputPassword1' class='form-label'>Obat</label>
                                            <select id="cboObat" class='select2bs4 w-100' required>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for='exampleInputPassword1' class='form-label'>Keterangan</label>
                                            <input type="text" id="keterangan_obat" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-6">
                                            <label for='exampleInputPassword1' class='form-label'>Aturan Pakai</label>
                                            <input type="text" id="aturan_pakai" class="form-control">
                                        </div>
                                        <div class="col-3">
                                            <label for='exampleInputPassword1' class='form-label'>Jumlah</label>
                                            <input type="number" id="jumlah" class="form-control">
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
                                                    <th>Nama</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Keterangan</th>
                                                    <th>Aturan Pakai</th>
                                                    <!-- <th>Aksi</th> -->
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
                                        <table id="tableAlat" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Pemakaian</th>
                                                    <th>Harga</th>
                                                    <th>Keterangan</th>
                                                    <!-- <th>Aksi</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="tableAlatBody">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class='mb-3'>
                                            <h3>Total Biaya : Rp. <span id="total-biaya-text">0</span></h3>
                                            <input type="hidden" name="total_biaya" id="total_biaya_input">
                                        </div>

                                <div class='mb-3'>
                                    <button id="btn-simpan-reservasi" class="btn btn-primary d-block w-100">Simpan Rekam Medis</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_rupiah.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <script src='../../js/rekam_medis.js'></script>
</body>

</html>