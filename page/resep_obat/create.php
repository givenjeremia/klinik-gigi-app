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
                            <h3 class='card-title'>Buat Resep Obat</h3>
                        </div>
                        <div class='card-body'>
                            <form id='FormCreateResepObat' enctype="multipart/form-data">
                                <div class='mb-3'>
                                    <label for='exampleInputPassword1' class='form-label'>Data Rekam Medis</label>
                                    <select id="cboRekamMedis" name='rekam_medis' class=' select2bs4 w-100' required>
                                    </select>
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
                                        <!-- <div class="col">
                                            <label for='exampleInputPassword1' class='form-label'>Status</label>
                                            <div class="form-check">
                                                <input class="form-check-input" name="status" type="checkbox" value="1" id="status_kesediaan">
                                                <label class="form-check-label" for="status_kesediaan">
                                                    Ada
                                                </label>
                                            </div>
                                        </div> -->
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
                                                    <th>Status Kesediaan</th>
                                                    <!-- <th>Aksi</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="tableObatBody">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class='mb-3'>
                                    <h3>Total Harga Resep : Rp. <span id="total-harga-text">0</span></h3>
                                    <input type="hidden" name="total_harga" id="total_harga_input">
                                </div>

                                <div class='mb-3'>
                                    <button id="btn-simpan-resep-obat" class="btn btn-primary d-block w-100">Simpan Resep Obat</button>
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
    <script src='../../js/resep_obat.js'></script>
    <script>
          getRekamMedis();
          getObat();
    </script>
</body>

</html>