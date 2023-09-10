function getDataPengajuanNota() {
    $("#hasil-pengajuan-nota").html();
    var url = "../../backend/keuangan/pengajuan_nota.php";
    $.ajax(url, {
        dataType: "json",
        timeout: 500,
        success: function (data, status, xhr) {
            if (data[0].status === "oke") {
                $(".data").remove();
                data[0].data.forEach((element, key) => {
                    $("#hasil-pengajuan-nota").append("<tr class='data' id='tr_" + key + "'>");
                    $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                    $("#tr_" + key).append("<th>" + element["IdNota"] + "</th>");
                    $("#tr_" + key).append("<th>" + element["IdRekamMedis"] + "</th>");
                    $("#tr_" + key).append("<th>" + element["NamaPasien"] + "</th>");
                    $("#tr_" + key).append("<th>" + convertDate(element["TanggalPemeriksaan"]) + "</th>");
                    $("#tr_" + key).append("<th>Rp. " + formatRupiah(element["TotalTarif"]) + "</th>");
                    var action =
                    `<th>
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalVerifNota" onClick="verifNotaForm(` + element["IdNota"] +`,` + element["IdRekamMedis"] +`,'` + element["NamaPasien"] +`','` + element["TanggalPemeriksaan"] +`',` + element["TotalTarif"] +`)"><i class="fa fa-check"></i></a> 
                    <a href="#" class="btn btn-danger" onClick="tolakNota(` + element["IdNota"]  +`)"><i class="fa fa-trash"></i></a>
                    </th>`;
                    $("#tr_" + key).append(action);
                    $("#hasil-pengajuan-nota").append("</tr>");
                });

            }
            $("#pengajuan-nota")
                .DataTable({
                    bDestroy: true,
                    responsive: true,
                });
        },
    });
}

function verifNotaForm(id,IdRekamMedis,NamaPasien,tanggal,tarif){
    $("#rekamMedisVerif").val(IdRekamMedis);
    $("#namaPasienVerif").val(NamaPasien);
    $("#tanggalVerif").val(tanggal);
    $("#totalPembayaranVerif").val(tarif);
    $("#submit_edit").attr("key", id);
}

$("#submit_edit").on("click", function (e) {
    var id = $(this).attr("key");
    e.preventDefault();
    var form = document.querySelector("#FormVerifNota");
    var form_data = new FormData(form);
    form_data.append('id', id);
    form_data.append('status','approved');
    var url = "../../backend/keuangan/update_pengajuan_nota.php";
    $.ajax({
      type: "POST",
      url: url,
      data: form_data,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data, status, xhr) {
        if (data.status == "success") {
          Swal.fire({
            title: "Success",
            text: "Nota Berhasil Di Verifikasi",
            icon: "success",
            showConfirmButton: true,
          }).then(result => {
            $("#close_edit").click();
            for (var key of form_data.keys()) {
              form_data.delete(key);
            }
            $("#pengajuan-nota").DataTable().destroy();
            getDataPengajuanNota() 
          })
        
        } else {
          Swal.fire({
            title: "Error",
            text: "Nota Gagal Di Verifkasi",
            icon: "error",
            showConfirmButton: true,
          });
        }
        getDataPengajuanNota() 
      },
    });
  });

function tolakNota(id) {
    var form_data = new FormData();
    form_data.append('id', id);
    form_data.append('status','rejected');
    var url = "../../backend/keuangan/update_pengajuan_nota.php";
    $.ajax({
      type: "POST",
      url: url,
      data: form_data,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data, status, xhr) {
        if (data.status == "success") {
          Swal.fire({
            title: "Success",
            text: "Nota Berhasil Di Tolak",
            icon: "success",
            showConfirmButton: true,
          }).then(result => {
            $("#close_edit").click();
            for (var key of form_data.keys()) {
              form_data.delete(key);
            }
            $("#pengajuan-nota").DataTable().destroy();
            getDataPengajuanNota() 
          })
        
        } else {
          Swal.fire({
            title: "Error",
            text: "Nota Gagal Di Tolak",
            icon: "error",
            showConfirmButton: true,
          });
        }
        getDataPengajuanNota() 
      },
    });
}


function getDataDaftarNota() {
    $("#hasil-daftar-nota").html();
    var url = "../../backend/keuangan/nota.php";
    $.ajax(url, {
        dataType: "json",
        timeout: 500,
        success: function (data, status, xhr) {
            if (data[0].status === "oke") {
                $(".data").remove();
                console.log(data);
                data[0].data.forEach((element, key) => {
                    $("#hasil-daftar-nota").append("<tr class='data' id='tr_" + key + "'>");
                    $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                    $("#tr_" + key).append("<th>" + element["IdNota"] + "</th>");
                    $("#tr_" + key).append("<th>" + element["NamaPasien"] + "</th>");
                    $("#tr_" + key).append("<th>" + convertDate(element["TanggalNota"]) + "</th>");
                    $("#tr_" + key).append("<th>" + element["IdRekamMedis"] + "</th>");
                    $("#tr_" + key).append("<th>Rp. " + formatRupiah(element["TotalPembayaran"]) + "</th>");
                    $("#tr_" + key).append("<th>" + (element["StatusNota"]) + "</th>");
                    // <a href="#" class="btn btn-danger" onClick="tolakNota(` + element["IdNota"]  +`)"><i class="fa fa-trash"></i></a>
                    var action =
                    `<th> 
                    <a href="../../page/keuangan/cetak_nota.php?id_nota=${element["IdNota"]}" target="_BLANK" class="btn btn-primary"><i class="fa fa-print"></i></a>

                    </th>`;
                    $("#tr_" + key).append(action);
                    $("#hasil-daftar-nota").append("</tr>");
                });

            }
            $("#daftar-nota")
                .DataTable({
                    bDestroy: true,
                    responsive: true,
                });
        },
    });
}


function getDataCatatanKeuangan() {
    $("#hasil-catatan-keuangan").html();
    var url = "../../backend/keuangan/catatan_keuangan.php";
    $.ajax(url, {
        dataType: "json",
        timeout: 500,
        success: function (data, status, xhr) {
            if (data[0].status === "oke") {
                $(".data").remove();
                console.log(data);
                data[0].data.forEach((element, key) => {
                    var nota = element["nota_id"] ? element["nota_id"] : 'Tanpa Nota';
                    $("#hasil-catatan-keuangan").append("<tr class='data' id='tr_" + key + "'>");
                    $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                    $("#tr_" + key).append("<th>" + convertDate(element["tanggal_masuk"]) + "</th>");
                    $("#tr_" + key).append("<th>" + element["keterangan"] + "</th>");
                    $("#tr_" + key).append("<th>Rp. " + formatRupiah(element["jumlah"]) + "</th>");
                    $("#tr_" + key).append("<th>" + (element["jenis_transaksi"]) + "</th>");
                    $("#tr_" + key).append("<th>" + nota + "</th>");
                    // var action =
                    // `<th> 
                    // <a href="#" class="btn btn-danger" onClick="tolakNota(` + element["IdNota"]  +`)"><i class="fa fa-trash"></i></a>
                    // </th>`;
                    // $("#tr_" + key).append(action);
                    $("#hasil-catatan-keuangan").append("</tr>");
                });

            }
            $("#daftar-catatan-keuangan")
                .DataTable({
                    bDestroy: true,
                    responsive: true,
                });
        },
    });
}

$("#dengan_nota").on("click", function () {
  var status = $(this).is(":checked");
  if (status) {
    var url = "../../backend/keuangan/nota_status_approved.php";
    $('#daftar_nota_select').html("")
    $('#daftar_nota_select').append('<option value="">Pilih Nota</option>')
    $.ajax(url, {
      dataType: "json",
      timeout: 500,
      success: function (data, status, xhr) {
        if (data[0].status === "oke") {
          data[0].data.forEach((element, key) => {
            $('#daftar_nota_select').append(`<option value="${element["IdNota"]}" harga="${element['TotalPembayaran']}" tanggal="${element['TanggalNota']}">${element["NamaPasien"]} - ${convertDate(element["TanggalNota"])} - ${element["IdRekamMedis"]}</option>`)
          });
        }
        else{
            $('#daftar_nota_select').append('<option value="">Tidak Ada Nota</option>')
        }
      },
    });
    $("#daftar-nota-cbo").removeClass("d-none");
  } else {
    $("#daftar-nota-cbo").addClass("d-none");
  }
});

$('#daftar_nota_select').on('change', function(){
    var value = $(this).val();
    if(value){
        var jumlah = $(this).find('option:selected').attr('harga');
        var tanggal = $(this).find('option:selected').attr('tanggal');
        $('#jumlah').val(formatRupiah(jumlah))
        $('#tanggal_masuk').val(tanggal);
    }
})

$("#submit_add").on("click", function (e) {
    e.preventDefault();
    var form = document.querySelector("#FormTambahCatatanKeuangan");
    var form_data = new FormData(form);
    var url = "../../backend/keuangan/insert_catatan_keuangan.php";
    $.ajax({
      type: "POST",
      url: url,
      data: form_data,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.status == "success") {
          Swal.fire({
            title: "Success",
            text: "Catatan Keuangan Berhasil Ditambahkan",
            icon: "success",
            showConfirmButton: true,
          })
          $("#close_add").click();
          for (var key of form_data.keys()) {
            console.log(key)
              form_data.delete(key);
          }
           $("#daftar-catatan-keuangan").DataTable().destroy();
           getDataCatatanKeuangan() 
            console.log('Complate')
        } else {
          Swal.fire({
            title: "Error",
            text: "Catatan Keuangan Gagal Di Tambahkan",
            icon: "error",
            showConfirmButton: true,
          });
        }
      },
    });
  });