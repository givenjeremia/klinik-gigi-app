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
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pengingat</label>
                            <select name="hari" id="pilih_hari" class=" form-control w-25" required>
                                <option value="hari_ini">Hari Ini</option>
                                <option value="besok">Besok</option>
                                <option value="terlewati">Terlewati</option>
                            </select>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Pengingat <span id="jenis_pengingat">Hari Ini</span></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Antrian</th>
                                            <th>Nama Dokter</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hasil">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>No Antrian</th>
                                            <th>Nama Dokter</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
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
    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <script src="../../js/pengingat.js"></script>
</body>

</html>