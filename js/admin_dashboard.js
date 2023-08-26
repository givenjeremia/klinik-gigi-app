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
    timeout: 500,
    success: function (data, status, xhr) {
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
                <a href="../rekam_medis/create.php?reservasi=${element['IdReservasi']}&dokter=${element['IdJadwalDokter']}" class="btn btn-primary"><i class="fa fa-plus"></i></a> 
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
