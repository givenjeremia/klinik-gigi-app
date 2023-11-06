function getData() {
    $("#hasil").html();
    var url = "../../backend/resep_obat/data.php";
    $.ajax(url, {
      dataType: "json", 
      timeout: 500,
      success: function (data, status, xhr) {
        if (data[0].status === "oke") {
          $(".data").remove();
          data.forEach((element, key) => {
            $("#hasil").append("<tr class='data' id='tr_" + key + "'>");
            $("#tr_" + key).append("<th scope='row'>" + element.data["id"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["NamaPasien"] + "</th>");
            $("#tr_" + key).append("<th>" + convertDate(element.data["tanggal_pemeriksaan"]) + "</th>");
            $("#tr_" + key).append("<th>" + element.data["Obat"] + "</th>");
            $("#tr_" + key).append("<th>Rp. " + formatRupiah(element.data["TotalHargaObat"]) + "</th>");
            var action =
              `<th>  
                  <a href="../../backend/rekam_medis/cetak_resep_pulang.php?rekam_medis=${element.data["id"]}&nama_pasien=${element.data["NamaPasien"]}" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> </a> 
              </th>`;
            $("#tr_" + key).append(action);
            $("#hasil").append("</tr>");
          });
          
          $("#example1")
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


  function getRekamMedis() {
    $("#cboRekamMedis").html();
    $("#cboRekamMedis").append("<option value=''>Pilih Rekam Medis</option>");
    var url = "../../backend/resep_obat/get_data_rekam_medis.php";
    $.ajax(url, {
      dataType: "json",
      timeout: 500,
      success: function (data, status, xhr) {
        if (data[0].status === "oke") {
          data.forEach((element, key) => {
            $("#cboRekamMedis").append(
              `<option value="${element.data['id']}" >${element.data['id']} - ${element.data['NamaPasien']} - ${convertDate(element.data['tanggal_pemeriksaan'])}</option>`
            );
          });
        }
      },
    });
  }

  function getObat() {
    $("#cboObat").html();
    $("#cboObat").append("<option value=''>Pilih Obat</option>");
    var url = "../../backend/obat/data.php";
    $.ajax(url, {
      dataType: "json", // type of response data
      timeout: 500, // timeout milliseconds
      success: function (data, status, xhr) {
        if (data[0].status === "oke") {
          data.forEach((element, key) => {
            $("#cboObat").append(
              `<option value="${element.data["id"]}" harga="${element.data["harga"]}" namaObat="${element.data["nama"]}">${element.data["nama"]}</option>`
            );
          });
        }
      },
    });
  }


  function setTotalHarga(harga){
    $("#total-harga-text").html(formatRupiah(harga));
    $("#total_harga_input").val(harga);
  }
  

  var total_biaya = 0;

var countObat = 1;

$("#btn-tambah-obat").on("click", function(e){
    e.preventDefault()
    var obat_id = $('#cboObat').val()
    if(obat_id != ""){
      var status_kesediaan = $('#status_kesediaan').is(":checked") ?  1 : 0;
      var status_kesediaan_text = status_kesediaan == 0 ?  'Tidak Ada' : 'Ada';
      var nama_obat = $('#cboObat option:selected').attr("namaObat")
      var harga_obat = $('#cboObat option:selected').attr("harga")
      var keterangan_obat = $('#keterangan_obat').val()
      var aturan_pakai = $('#aturan_pakai').val()
      var jumlah = $('#jumlah').val()
      var total_harga = parseInt(jumlah) * parseInt(harga_obat)
      $('#tableObatBody').append(`<tr id="tr_obat_${obat_id}">`)
      $('#tableObatBody').append(`<td>${nama_obat} <input type="hidden" name="obat[${countObat}][id_obat]" value="${obat_id}"> </td>`)
      $('#tableObatBody').append(`<td>${jumlah} <input type="hidden" name="obat[${countObat}][jumlah]" value="${jumlah}"> </td>`)
      $('#tableObatBody').append(`<td>Rp. ${formatRupiah(total_harga)} <input type="hidden" name="obat[${countObat}][total_harga]" value="${total_harga}"></td>`)
      $('#tableObatBody').append(`<td>${keterangan_obat} <input type="hidden" name="obat[${countObat}][keterangan]" value="${keterangan_obat}"> </td>`)
      $('#tableObatBody').append(`<td>${aturan_pakai} <input type="hidden" name="obat[${countObat}][aturan_pakai]" value="${aturan_pakai}"> </td>`)
      $('#tableObatBody').append(`<td>${status_kesediaan_text} <input type="hidden" name="obat[${countObat}][status_kesediaan]" value="${status_kesediaan}"> </td>`)
      // $('#tableObatBody').append(`<td><button></td>`)
      $('#tableObatBody').append("</tr>")
      countObat++;
      // Tambah harga
      total_biaya = parseInt(total_biaya) + parseInt(total_harga)
      setTotalHarga(total_biaya)
    }
    else{
      Swal.fire({
        title: "Error",
        text: 'Harap Pilih Obat',
        icon: "error",
        showConfirmButton: true,
      });
    }
})


$('#btn-simpan-resep-obat').on('click', function(e){
    e.preventDefault();
    var form = document.querySelector("#FormCreateResepObat");
    var form_data = new FormData(form);
    var url = "../../backend/resep_obat/insert.php";
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
            text: data.msg,
            icon: "success",
            showConfirmButton: true,
          }).then((result) => {
            window.location.href = '../../page/resep_obat/index.php';
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

  