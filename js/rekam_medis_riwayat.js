function getDetailPasien() {
  var id_pasien = $("#id_pasien").val();
  var bytes = CryptoJS.AES.decrypt(id_pasien.toString(), "Klinik-GIGI-APPS");
  var id_pasien = bytes.toString(CryptoJS.enc.Utf8);

  if (id_pasien != "") {
    var url = "../../backend/pasien/get_data_by_id.php";
    $.ajax(url, {
      type: "post",
      data: {
        id: id_pasien,
      },
      dataType: "json",
      timeout: 500,
      success: function (data, status, xhr) {
        if (data[0].status == "success") {
          $("#nama_pasien").html(data[0].data.nama);
          $("#tanggal_lahir_pasien").html(data[0].data.tempat_tanggal_lahir);
          $("#no_telepon_pasien").html(data[0].data.no_telp);
          $("#alamat_pasien").html(data[0].data.alamat);
          $("#jenis_kelamin_pasien").html(data[0].data.jenis_kelamin);
          $("#umur_pasien").html(data[0].data.usia + " Tahun");
        } else {
          // window.location.href ='/'
        }
      },
    });
  } else {
    // window.location.href ='/'
  }
}
getDetailPasien();

function getRekamMedisPasien() {
  var id_pasien = $("#id_pasien").val();
  var bytes = CryptoJS.AES.decrypt(id_pasien.toString(), "Klinik-GIGI-APPS");
  var id_pasien = bytes.toString(CryptoJS.enc.Utf8);
  if (id_pasien != "") {
    var url = "../../backend/rekam_medis/get_data_by_id_pasien.php";
    $.ajax(url, {
      type: "post",
      data: {
        id: id_pasien,
      },
      dataType: "json",
      timeout: 500,
      success: function (data, status, xhr) {
        if (data[0].status === "success") {
          $(".data").remove();
          data.forEach((element, key) => {
            $("#hasil").append("<tr class='data' id='tr_" + key + "'>");
            $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
            $("#tr_" + key).append(
              "<th>" +
                convertDate(element.data["tanggal_pemeriksaan"]) +
                "</th>"
            );
            $("#tr_" + key).append("<th>" + element.data["keluhan"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["diagnosa"] + "</th>");
            
            $("#tr_" + key).append(`
                  <th>
                  <button onclick="detailRekamMedis(${element.data["id"]})" data-toggle="modal" data-target="#modal-lg" class="btn btn-info"><i class="fa fa-info"></i></button> 
                  <a href="'../../../../page/odontogram/data.php?data=${element.data["id"]}"  target="_blank" class="btn btn-secondary"><i class="fa fa-tooth"></i></a> 
                  </th>
                  `);

            $("#hasil").append("</tr>");
          });

          $("#example1")
            .DataTable({
              bDestroy: true,
              responsive: true,
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");
        }
      },
    });
  } else {
    // window.location.href ='/'
  }
}
getRekamMedisPasien();

function detailRekamMedis(id) {
  // Get Detail
  $('#informasi-keluhan').html("adadsa");
  var url =
    "../../backend/rekam_medis/get_data_by_id.php?id=" + id;
  $.ajax(url, {
    dataType: "json",
    timeout: 500,
    success: function (data, status, xhr) {
      if (data[0].status === "success") {
        console.log(data[0].data.keluhan)
        $('#informasi-keluhan').html(data[0].data.keluhan);
        $('#informasi-diagnosa').html(data[0].data.diagnosa);
        if(data[0].data.gambar != null){
          var img = `
          <img src="../../assets/uploads/rekam_medis/${id}/${data[0].data.gambar}" class="img-fluid" alt="">
          `;
          $("#custom-tabs-lampiran").html(img)
        }
        else{
          $("#custom-tabs-lampiran").html('<h6>Tidak Ada Lampiran</h6>')
        }

      }
    },
  });

  // From Keuangan
  // Get Tindakan
  $("#hasil-daftar-tindakan").html();
  var url =
    "../../backend/keuangan/get_tindakan_by_rm_id.php?rekam_medis=" + id;
  $.ajax(url, {
    dataType: "json",
    timeout: 500,
    success: function (data, status, xhr) {
      // success callback function
      if (data[0].status === "oke") {
        $(".data-daftar-tindakan").remove();

        data.forEach((element, key) => {
          $("#hasil-daftar-tindakan").append(
            "<tr class='data-daftar-tindakan' id='tr_daftar-tindakan_" +
              key +
              "'>"
          );
          $("#tr_daftar-tindakan_" + key).append(
            "<th scope='row'>" + (key + 1) + "</th>"
          );
          $("#tr_daftar-tindakan_" + key).append(
            "<th>" + element.data["nama"] + "</th>"
          );
          $("#tr_daftar-tindakan_" + key).append(
            "<th>" + element.data["jumlah"] + "</th>"
          );
          $("#tr_daftar-tindakan_" + key).append(
            "<th>" + element.data["catatan"] + "</th>"
          );
          $("#tr_daftar-tindakan_" + key).append(
            "<th>Rp. " + formatRupiah(parseInt(element.data["harga"]) * parseInt(element.data["jumlah"])) + "</th>"
          );
          $("#hasil-daftar-tindakan").append("</tr>");
        });

        $("#daftar-tindakan")
          .DataTable({
            bDestroy: true,
            responsive: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          })
          .buttons()
          .container()
          .appendTo("#example1_wrapper .col-md-6:eq(0)");
      }
    },
  });
  // Get Obat
  $("#hasil-daftar-obat").html();
  var url = "../../backend/keuangan/get_obat_by_rm_id.php?rekam_medis=" + id;
  $.ajax(url, {
    dataType: "json",
    timeout: 500,
    success: function (data, status, xhr) {
      // success callback function
      if (data[0].status === "oke") {
        $(".data-daftar-obat").remove();

        data.forEach((element, key) => {
          $("#hasil-daftar-obat").append(
            "<tr class='data-daftar-obat' id='tr_daftar-obat_" + key + "'>"
          );
          $("#tr_daftar-obat_" + key).append("<th>" + (key + 1) + "</th>");
          $("#tr_daftar-obat_" + key).append(
            "<th>" + element.data["NamaObat"] + "</th>"
          );
          $("#tr_daftar-obat_" + key).append(
            "<th>" + element.data["jumlah_pemakaian"] + "</th>"
          );
          $("#tr_daftar-obat_" + key).append(
            "<th>Rp. " + formatRupiah(element.data["harga"]) + "</th>"
          );
          $("#hasil-daftar-obat").append("</tr>");
        });

        $("#daftar-obat")
          .DataTable({
            bDestroy: true,
            responsive: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          })
          .buttons()
          .container()
          .appendTo("#example1_wrapper .col-md-6:eq(0)");
      }
    },
  });
  // Get Alat
  $("#hasil-daftar-alat").html();
  var url = "../../backend/keuangan/get_alat_by_rm_id.php?rekam_medis=" + id;
  $.ajax(url, {
    dataType: "json",
    timeout: 500,
    success: function (data, status, xhr) {
      // success callback function
      if (data[0].status === "oke") {
        $(".data-daftar-alat").remove();

        data.forEach((element, key) => {
          $("#hasil-daftar-alat").append(
            "<tr class='data-daftar-alat' id='tr_daftar-alat_" + key + "'>"
          );
          $("#tr_daftar-alat_" + key).append(
            "<th scope='row'>" + (key + 1) + "</th>"
          );
          $("#tr_daftar-alat_" + key).append(
            "<th>" + element.data["NamaAlat"] + "</th>"
          );
          $("#tr_daftar-alat_" + key).append(
            "<th>" + element.data["jumlah_pemakaian"] + "</th>"
          );
          $("#tr_daftar-alat_" + key).append(
            "<th>" + element.data["keterangan"] + "</th>"
          );
          $("#tr_daftar-alat_" + key).append(
            "<th>Rp. " + formatRupiah(element.data["harga"]) + "</th>"
          );
          $("#hasil-daftar-tindakan").append("</tr>");
        });

        $("#daftar-tindakan")
          .DataTable({
            bDestroy: true,
            responsive: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          })
          .buttons()
          .container()
          .appendTo("#example1_wrapper .col-md-6:eq(0)");
      }
    },
  });
}

function showTambahRekamMedis() {
  var date = new Date();
  var dateString = date.toISOString().split("T")[0];
  var tanggal = $("#tanggal").val();
  // alert(tanggal)
  var bytes = CryptoJS.AES.decrypt(tanggal.toString(), "Klinik-GIGI-APPS");
  // alert(bytes)
  var tanggal = bytes.toString(CryptoJS.enc.Utf8);

  // Dekrip
  var id_reservasi = $("#id_reservasi").val();
  // var bytes  = CryptoJS.AES.decrypt(id_reservasi.toString(), 'Klinik-GIGI-APPS');
  // var id_reservasi = bytes.toString(CryptoJS.enc.Utf8);
  var id_jadwal_dokter = $("#dokter").val();
  // var bytes  = CryptoJS.AES.decrypt(id_jadwal_dokter.toString(), 'Klinik-GIGI-APPS');
  // var id_jadwal_dokter= bytes.toString(CryptoJS.enc.Utf8);

  if (dateString == tanggal) {
    var action = `
    <a href="../rekam_medis/create_v2.php?reservasi=${id_reservasi}&dokter=${id_jadwal_dokter}" class="btn btn-primary" target="_blank">
        Tambah Rekam Medis
    </a>`;
    $("#card-tools-rekam-medis").html(action);
  }
}
showTambahRekamMedis();
