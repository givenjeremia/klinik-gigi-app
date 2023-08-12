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
                                                <select name="jadwal_dokter" id="dokter_hari_ini" class="select2bs4 w-100" required>
                                                    <!-- <option value="">Pilih Nama Dokter</option>
                                                    <option value="laki-laki">Laki - Laki</option>
                                                    <option value="Perempuan">Perempuan</option> -->
                                                </select>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="exampleInputPassword1">Tanggal</label>
                                                <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Tanggal">
                                            </div> -->
                                            <!-- <div class="form-group">
                                                <label for="exampleInputPassword1">Jam</label>
                                                <input type="time" class="form-control" id="exampleInputPassword1" placeholder="Jam">
                                            </div> -->
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
    <script>
        function getDataDokterHariIni() {
            $.ajax({
                type: "GET",
                url: "../../backend/dashboard/pasien/data_dokter.php",
                dataType: "json",
                success: function(data) {
                    $('#dokter_hari_ini').empty();
                    if (data[0].status == 'oke') {
                        $('#dokter_hari_ini').append('<option value="">Pilih Nama Dokter</option>');
                        $.each(data[0].data, function(i, item) {
                            console.log(item)
                            $('#dokter_hari_ini').append('<option value="' + item.id_jadwal + '">' + item.nama_dokter + ' - ' + item.jam + '</option>');
                        });
                    } else {
                        $('#dokter_hari_ini').append('<option value="">Tidak Ada Dokter Hari Ini</option>');
                    }
                }
            });
        }
        getDataDokterHariIni()

        $('#btn-reservasi').on('click', function() {
            var form = document.querySelector('#form-reservasi');
            var form_data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "../../backend/dashboard/pasien/insert_reservasi.php",
                data: form_data,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        Swal.fire({
                            title: "Success",
                            text: "Reservasi Berhasil Ditambahkan",
                            icon: "success",
                            showConfirmButton: true,
                        }).then((result) => {
                            window.location.reload()
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Reservasi Gagal Di Tambahkan",
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                },
            });
        });
    </script>
</body>

</html>