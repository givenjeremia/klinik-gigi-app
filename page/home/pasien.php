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
                <section class="content">

                    <div class="container-fluid">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>Hai, <?= $_SESSION['auth']['username'] ?></h3>
                                <p>And Login Sebagai, <?= $_SESSION['auth']['role'] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <section class="col-lg-7 connectedSortable">
                                <img src="../../assets/brand/5063407.png" alt="" class="w-100">

                            </section>

                            <section class="col-lg-5 connectedSortable">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Reservasi
                                        </h3>      
                                    </div>
                                    <div class="card-body">
                                        <form id="form-reservasi">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="form-label">Dokter Hari Ini</label>
                                                <select name="dokter_hari_ini" id="dokter_hari_ini" class="select2bs4 w-100" required>
                                                    <!-- <option value="">Pilih Nama Dokter</option>
                                                    <option value="laki-laki">Laki - Laki</option>
                                                    <option value="Perempuan">Perempuan</option> -->
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tanggal</label>
                                                <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Tanggal">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Jam</label>
                                                <input type="time" class="form-control" id="exampleInputPassword1" placeholder="Jam">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary" id="btn-reservasi">Reservasi</button>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include '../layouts/script.php' ?>
    <script src="../../js/karyawan.js"></script>
</body>

</html>