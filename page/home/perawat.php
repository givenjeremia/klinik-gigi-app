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
                                                <th>Dokter</th>
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
                                                <th>Dokter</th>
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
                            $("#tr_pasien" + key).append("<th>" + element.data["NamaDokter"] + "</th>");
                            $("#tr_pasien" + key).append("<th>" + element.data["NamaPasien"] + "</th>");
                            $("#tr_pasien" + key).append("<th>" + element.data["Jam"] + "</th>");
            //                 var action =
            //                     `<th>  
            //     <a href="../rekam_medis/create.php?reservasi=${element.data['IdReservasi']}&dokter=${element.data['IdJadwalDokter']}" class="btn btn-primary"><i class="fa fa-plus"></i></a> 
            // </th>`;
                            var action = ''
                            if(element.data['StatusKehadiran'] == 'pending'){
                                action =
                                `<th>  
                                    <button onclick="kehadiran('${element.data['IdReservasi']}','hadir')" class="btn btn-primary"><i class="fa fa-check"></i></button> 
                                    <button onclick="kehadiran('${element.data['IdReservasi']}','tidak hadir')"  class="btn btn-danger"><i class="fa fa-times"></i></button> 
                                </th>`;
                            }
                            else{
                                console.log(element.data['Tanggal'])
                                // action =
                                // `<th>  
                                //   <a href="../rekam_medis/create.php?reservasi=${element.data['IdReservasi']}&dokter=${element.data['IdJadwalDokter']}&namaDokter=${element.data['NamaDokter']}&tanggal=${convertDate(element.data['Tanggal'])}&jam=${element.data['Jam']}&spesialis_id=${element.data['spesialis_id']}&spesialis_nama=${element.data['spesialis_nama']}" class="btn btn-primary"><i class="fa fa-plus"></i></a> 
                                // </th>`
                                var pasien = CryptoJS.AES.encrypt(element.data['IdPasien'], 'Klinik-GIGI-APPS');
                                var reservasi = CryptoJS.AES.encrypt(element.data['IdReservasi'], 'Klinik-GIGI-APPS');
                                var tanggal = CryptoJS.AES.encrypt(element.data['Tanggal'], 'Klinik-GIGI-APPS');
                                var dokter = CryptoJS.AES.encrypt(element.data['IdJadwalDokter'], 'Klinik-GIGI-APPS');
                                action =
                                `<th>  
                                <a href="../rekam_medis/riwayat.php?data=${pasien}&reservasi=${reservasi}&tanggal=${tanggal}&dokter=${dokter}" class="btn btn-primary"><i class="fa fa-plus"></i></a> 
                                </th>`

                            }
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
    <script>
        function kehadiran(id,status) {
  Swal.fire({
    title: "Konfirmasi",
    text: "Apakah anda yakin akan mengkonfirmasi kehadiran?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hadir",
    cancelButtonText: "Batal",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      var url = "../../backend/reservasi_klinik/update_status_kehadiran.php";
      $.ajax(url, {
        type: "post",
        data: {
          id: id,
          status: status,
        },
        dataType: "json",
        timeout: 500,
        success: function (data, status, xhr) {
          if (data.status == "success") {
              Swal.fire({
                title: "Success",
                text: "Status Berhasil Diubah",
                icon: "success",
                showConfirmButton: true,
              }).then(result => {
                window.location.reload()
              })
            } else {
              Swal.fire({
                title: "Error",
                text: "Status Gagal Di Ubah",
                icon: "error",
                showConfirmButton: true,
              });
            }
        },
      });
    }
  });
}

    </script>
</body>

</html>