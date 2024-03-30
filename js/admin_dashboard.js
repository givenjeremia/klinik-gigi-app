function getDataDokterHariIni() {
  $("#hasil-jadwal-dokter").html();
  $.ajax({
    type: "GET",
    url: "../../backend/dashboard/pasien/data_dokter.php",
    dataType: "json",
    success: function (data) {
      $(".data-jadwal-dokter").remove();
      if (data[0].status == "oke") {
        $.each(data[0].data, function (i, item) {
          // $('#dokter_hari_ini').append('<option value="' + item.id_jadwal + '">' + item.nama_dokter + ' - ' + item.jam + '</option>');
          $("#hasil-jadwal-dokter").append(
            "<tr class='data-jadwal-dokter' id='tr_" + i + "'>"
          );
          $("#tr_" + i).append("<th scope='row'>" + (i + 1) + "</th>");
          $("#tr_" + i).append("<th>" + item.nama_dokter + "</th>");
          $("#tr_" + i).append("<th>" + item.jam + "</th>");
          $("#hasil-jadwal-dokter").append("</tr>");
        });
      }
      $("#jadwal-dokter")
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
getDataDokterHariIni();

function getDataLayananHariIni() {
  $("#hasil-layanan").html();
  $.ajax({
    type: "GET",
    url: "../../backend/rekam_medis/data_layanan_hari_ini.php",
    dataType: "json",
    success: function (data) {
      $(".data-layanan").remove();
      if (data[0].status === "oke") {
        data.forEach((element, key) => {
          $("#hasil-layanan").append(
            "<tr class='data-layanan' id='tr_layanan" + key + "'>"
          );
          $("#tr_layanan" + key).append("<th scope='row'>" + (key + 1) + "</th>");
          $("#tr_layanan" + key).append("<th>" + element.data["nama"] + "</th>");
          $("#tr_layanan" + key).append("<th>" + element.data["jenis"] + "</th>");
          $("#tr_layanan" + key).append("<th>" + element.data["harga"] + "</th>");
          $("#hasil-layanan").append("</tr>");
        });
      }
      $("#jadwal-layanan")
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
getDataLayananHariIni();

function getReservasi() {
    $("#hasil-jadwal").html();
  var url = "../../backend/rekam_medis/data_reservasi_hari_ini.php";
  $.ajax(url, {
    dataType: "json",
    timeout: 5000,
    success: function (data, status, xhr) {
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
          $("#tr_pasien" + key).append("<th>" + element.data["Treatment"] + "</th>");
          $("#tr_pasien" + key).append("<th>" + element.data["Keluhan"] + "</th>");

          $("#tr_pasien" + key).append("<th>" + element.data["Jam"] + "</th>");
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
        timeout: 5000,
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
