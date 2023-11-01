<?php include '../layouts/session_login.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../layouts/head.php' ?>
    <style>
        .disabled{
  pointer-events: none;
}
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?php include '../layouts/navbar.php' ?>
        <div class="content-wrapper">
            <div class="container-fluid pr-5 pl-5 pt-3">
                <div class="content">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Rekam Medis</label>
                        <select id="cboRekamMedis" name="rekam_medis" class="select2bs4" style="width: 100%;" required>
                            <option value="">Pilih Rekam Medis</option>
                            <option value="laki-laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <!-- <button type="button" onclick="formAddData()" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalTambah">
                        Add Odontogram
                    </button>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Data Odontogram</h3>
                        </div>
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
                                        </tr>
                                    </thead>
                                    <tbody id="hasil">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                    <div class="row justify-content-center align-content-center mb-3">
                            <div class="col-2">
                                <h2>Odontograma</h2>
                            </div>
                            <div class="col-2 text-start">
                                <label for="exampleInputPassword1" class="form-label">Aksi</label>
                                <select id="cboAksiGigi" name="aksi_gigi" class="select2bs4" style="width: 100%;" required>
                                    <option value="yellow">Caries</option>
                                    <option value="green">Tambalan</option>
                                    <option value="red">Brecket</option>
                                </select>
                            </div>
                        </div>
                    <div id="odontograma-wrapper" class=" justify-content-center align-content-center text-center">
                       
                        <div id="odontograma"></div>
                    </div>   
                    <div class="card mt-2 ">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Odontogram</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pasien</th>
                                            <th>Nomor Gigi</th>
                                            <th>Posisi</th>
                                            <th>Status</th>
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

    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <script src="../../assets/js_odontogram/modernizr-2.0.6.min.js"></script>
    <!-- <script defer src="../../assets/js_odontogram/jquery-1.7.1.min.js"></script> -->
  <script defer src="../../assets/js_odontogram/plugins.js"></script>
  <script defer src="../../assets/js_odontogram/jquery-ui-1.8.17.custom.min.js"></script>
  <script defer src="../../assets/js_odontogram/jquery.tmpl.js"></script>
  <script defer src="../../assets/js_odontogram/knockout-2.0.0.js"></script>
  <script defer src="../../assets/js_odontogram/jquery.svg.min.js"></script>  
  <script defer src="../../assets/js_odontogram/jquery.svggraph.min.js"></script>  
  <script src="../../js/odontogram_2.js"></script>
  <script src="../../js/odontogram.js"></script>
  <script>
    $('.sorting').click()
  </script>

</body>

</html>