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
                        <!-- Daftar Pasien Hari Ini -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>Daftar Pasien Reservasi Hari Ini</h3>
                                <div class="table-responsive">
                                    <table id="jadwal-pasien" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Antrian</th>
                                                <th>Nama Pasien</th>
                                                <th>Jam Reservasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasil-jadwal-pasien">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>No Antrian</th>
                                                <th>Nama Pasien</th>
                                                <th>Jam Reservasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include '../layouts/script.php' ?>
    <script>
        function getReservasi() {
            $("#hasil-jadwal").html();
            var url = "../../backend/rekam_medis/data_reservasi_hari_ini.php";
            $.ajax(url, {
                dataType: "json",
                timeout: 500,
                success: function(data, status, xhr) {
                    if (data[0].status === "oke") {
                        $(".data-pasien").remove();
                        data.forEach((element, key) => {
                            $("#hasil-jadwal-pasien").append(
                                "<tr class='data-pasien' id='tr_pasien" + key + "'>"
                            );
                            $("#tr_pasien" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                            $("#tr_pasien" + key).append("<th>" + element.data["NoAntrian"] + "</th>");
                            $("#tr_pasien" + key).append("<th>" + element.data["NamaPasien"] + "</th>");
                            $("#tr_pasien" + key).append("<th>" + element.data["Jam"] + "</th>");
                            var action =
                                `<th>  
                <a href="../rekam_medis/create.php?reservasi=${element.data['IdReservasi']}&dokter=${element.data['IdJadwalDokter']}" class="btn btn-primary"><i class="fa fa-plus"></i></a> 
            </th>`;
                            $("#tr_pasien" + key).append(action);
                            $("#hasil-jadwal-pasien").append("</tr>");

                        });

                    }
                    $("#jadwal-pasien")
                        .DataTable({
                            pageLength: 3,
                            bDestroy: true,
                            responsive: true,
                        })
                        .buttons()
                        .container()
                        .appendTo("#example1_wrapper .col-md-6:eq(0)");
                },
            });
        }
        getReservasi();
    </script>
</body>

</html>