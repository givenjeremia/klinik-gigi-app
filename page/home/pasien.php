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
                            <section class="col-lg-5 connectedSortable">
                                <img src="../../assets/brand/5063407.png" alt="" class="w-100">

                            </section>

                            <section class="col-lg-7 connectedSortable">
                                <div class="card w-100">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Reservasi
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <form id="form-reservasi">
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Pilih Hari</label>
                                                    <select name="hari" id="pilih_hari" class="select2bs4 w-100" required>
                                                        <option value="">Pilih Hari</option>
                                                        <option value="Monday">Senin</option>
                                                        <option value="Tuesday">Selasa</option>
                                                        <option value="Wednesday">Rabu</option>
                                                        <option value="Thursday">Kamis</option>
                                                        <option value="Friday">Jum'at</option>
                                                        <option value="Saturday">Sabtu</option>
                                                        <option value="Sunday">Minggu</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="form-label">Dokter Hari <span id="hari_select">Ini</span></label>
                                                <!-- <select name="jadwal_dokter" id="dokter_hari_ini" class="select2bs4 w-100" required>
                                
                                                </select> -->
                                                <div class='table-responsive'>
                                                    <table id='jadwal-dokter' class='table table-bordered table-striped'>
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama</th>
                                                                <th>Jam</th>
                                                                <th>Hari</th>
                                                                <th>Kuota Pasien</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id='hasil_jadwal'>
                                                            <!-- <tr>
                                                                <td>dqwq</td>
                                                            </tr> -->
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama</th>
                                                                <th>Jam</th>
                                                                <th>Hari</th>
                                                                <th>Kuota Pasien</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
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
                                    <!-- <div class="card-footer">
                                        <button type="button" class="btn btn-primary" id="btn-reservasi">Reservasi</button>
                                    </div> -->
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include '../reservasi/create.php' ?>
    <?php include '../layouts/script.php' ?>
    <script>
        var hariToIndo = {
            'Sunday': 'Minggu',
            'Monday': 'Senin',
            'Tuesday': 'Selasa',
            'Wednesday': 'Rabu',
            'Thursday': 'Kamis',
            'Friday': 'Jumat',
            'Saturday': 'Sabtu'
        };

        function getDataDokterHariIni() {
            var dataTable = $("#jadwal-dokter").DataTable();
            if ($.fn.DataTable.isDataTable("#jadwal-dokter")) {
                dataTable.destroy();
            }
            $.ajax({
                type: "GET",
                url: "../../backend/dashboard/pasien/data_dokter.php",
                dataType: "json",
                success: function(data) {
                    $('#dokter_hari_ini').empty();
                    if (data[0].status === "oke") {

                        $(".data_jadwal").remove();
                        console.log(data[0].data)
                        data[0].data.forEach((element, key) => {
                            console.log(element)

                            $("#hasil_jadwal").append("<tr class='data_jadwal' id='tr_jadwal_" + key + "'>");
                            $("#tr_jadwal_" + key).append("<td scope='row'>" + (key + 1) + "</td>");
                            $("#tr_jadwal_" + key).append("<td>" + element.nama_dokter + "</td>");
                            $("#tr_jadwal_" + key).append("<td>" + element.jam + "</td>");
                            $("#tr_jadwal_" + key).append("<td>" + hariToIndo[element.hari] + "</td>");
                            $("#tr_jadwal_" + key).append("<td>" + element.kuota + "</td>");
                            var action =
                                `<td>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalJadwalReservasi" onClick="createReservasi(` + element.id_jadwal + `)"><i class="fa fa-book"></i></a> 
                                </td>`;
                            $("#tr_jadwal_" + key).append(action);
                            $("#hasil_jadwal").append("</tr>");
                        });

                    }
                    $("#jadwal-dokter").DataTable({
                        responsive: true,
                    });
                }
            });
        }
        getDataDokterHariIni()
        $('#pilih_hari').on('change', function() {
            $('#hasil_jadwal').html();
            var url = "../../backend/dashboard/pasien/get_data_by_hari.php";
            var value = $(this).val();
            var dataTable = $("#jadwal-dokter").DataTable();
            if ($.fn.DataTable.isDataTable("#jadwal-dokter")) {
                dataTable.destroy();
            }

            $.ajax(url, {
                type: "POST",
                data: {
                    hari: value,
                },
                dataType: "json",
                timeout: 500,
                success: function(data, status, xhr) {
                    $(".data_jadwal").remove();
                    if (data[0].status === "oke") {
                        $('#hari_select').html(hariToIndo[data[0].hari_select])

                        console.log(data[0].data)
                        data[0].data.forEach((element, key) => {
                            console.log(element)

                            $("#hasil_jadwal").append("<tr class='data_jadwal' id='tr_jadwal_" + key + "'>");
                            $("#tr_jadwal_" + key).append("<td scope='row'>" + (key + 1) + "</td>");
                            $("#tr_jadwal_" + key).append("<td>" + element.nama_dokter + "</td>");
                            $("#tr_jadwal_" + key).append("<td>" + element.jam + "</td>");
                            $("#tr_jadwal_" + key).append("<td>" + hariToIndo[element.hari] + "</td>");
                            $("#tr_jadwal_" + key).append("<td>" + element.kuota + "</td>");
                            var action =
                                `<td>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalJadwalReservasi" onClick="createReservasi(` + element.id_jadwal + `)"><i class="fa fa-book"></i></a> 
                        </td>`;
                            $("#tr_jadwal_" + key).append(action);
                            $("#hasil_jadwal").append("</tr>");
                        });
                    }
                    $("#jadwal-dokter").DataTable({
                        responsive: true,
                    });
                },
            });
        });

        function createReservasi(id) {
            var url = "../../backend/reservasi_klinik/data_by_id.php";
            $.ajax(url, {
                type: "post",
                data: {
                    id: id,
                },
                dataType: "json",
                timeout: 500,
                success: function(data, status, xhr) {
                    if (data[0].status == "success") {
                        $('#jadwal_tambah').val(id);
                        $("#hari_tambah").val(hariToIndo[data[0].data.hari]);
                    }
                },
            });
        }
        $('#submit_add_reservasi').on('click', function() {
            var form = document.querySelector("#FormCreateReservasi");
            var form_data = new FormData(form);
            var url = "../../backend/reservasi_klinik/insert.php";
            $.ajax({
                type: "POST",
                url: url,
                data: form_data,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        Swal.fire({
                            title: "Success",
                            text: data.msg,
                            icon: "success",
                            showConfirmButton: true,
                        }).then((result) => {
                            $("#close_add").click();
                            // Reset Value
                            for (var key of form_data.keys()) {
                                form_data.delete(key);
                            }
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: data.msg,
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                },
            });
        })

        // $('#btn-reservasi').on('click', function() {
        //     var form = document.querySelector('#form-reservasi');
        //     var form_data = new FormData(form);
        //     $.ajax({
        //         type: "POST",
        //         url: "../../backend/dashboard/pasien/insert_reservasi.php",
        //         data: form_data,
        //         dataType: "json",
        //         contentType: false,
        //         processData: false,
        //         success: function(data) {
        //             if (data.status == "success") {
        //                 Swal.fire({
        //                     title: "Success",
        //                     text: "Reservasi Berhasil Ditambahkan",
        //                     icon: "success",
        //                     showConfirmButton: true,
        //                 }).then((result) => {
        //                     window.location.reload()
        //                 });
        //             } else {
        //                 Swal.fire({
        //                     title: "Error",
        //                     text: "Reservasi Gagal Di Tambahkan",
        //                     icon: "error",
        //                     showConfirmButton: true,
        //                 });
        //             }
        //         },
        //     });
        // });
    </script>
</body>

</html>