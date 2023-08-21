function getAlat() {
  $("#cboAlat").html();
  $("#cboAlat").append("<option value=''>Pilih Alat</option>");
  var url = "../../backend/alat/data.php";
  $.ajax(url, {
    dataType: "json",
    timeout: 500,
    success: function (data, status, xhr) {
      if (data[0].status === "oke") {
        data.forEach((element, key) => {
          $("#cboAlat").append(
            `<option value="${element.data["id"]}" harga="${element.data["harga"]}" namaAlat="${element.data["nama"]}">${element.data["nama"]}</option>`
          );
        });
      }
    },
  });
}
getAlat();

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
getObat();

var countObat = 1;

$("#btn-tambah-obat").on("click", function(e){
    e.preventDefault()
    var obat_id = $('#cboObat').val()
    var nama_obat = $('#cboObat option:selected').attr("namaObat")
    var harga_obat = $('#cboObat option:selected').attr("harga")
    var qty = $('#qty').val()
    var total_harga = parseInt(qty) * parseInt(harga_obat)
    $('#tableObatBody').append(`<tr id="tr_obat_${obat_id}">`)
    $('#tableObatBody').append(`<td>${nama_obat} <input type="hidden" name="obat['${countObat}']['id_obat']" value="${obat_id}"> </td>`)
    $('#tableObatBody').append(`<td>${qty} <input type="hidden" name="obat['${countObat}']['qty']" value="${qty}"> </td>`)
    $('#tableObatBody').append(`<td>Rp. ${formatRupiah(total_harga)} <input type="hidden" name="obat['${countObat}']['total_harga']" value="${total_harga}"></td>`)
    // $('#tableObatBody').append(`<td><button></td>`)
    $('#tableObatBody').append("</tr>")
    countObat++;
})

function deleteObat(id) {
    $('#tr_obat_'+id).remove();
}

var countAlat = 1;

$("#btn-tambah-alat").on("click", function(e){
    e.preventDefault()
    var alat_id = $('#cboAlat').val()
    var nama_alat = $('#cboAlat option:selected').attr("namaAlat")
    var harga_alat = $('#cboAlat option:selected').attr("harga")
    var pemakaian  = $('#pemakaian').val()
    var keterangan  = $('#keterangan').val()
    $('#tableAlatBody').append(`<tr id="tr_alat_${alat_id}">`)
    $('#tableAlatBody').append(`<td>${nama_alat} <input type="hidden" name="alat['${countAlat}']['id_alat']" value="${alat_id}"> </td>`)
    $('#tableAlatBody').append(`<td>${pemakaian} <input type="hidden" name="alat['${countAlat}']['pemakaian']" value="${qty}"> </td>`)
    $('#tableAlatBody').append(`<td>Rp. ${formatRupiah(harga_alat)} <input type="hidden" name="alat['${countAlat}']['harga_alat']" value="${harga_alat}"></td>`)
    $('#tableAlatBody').append(`<td>${keterangan} <input type="hidden" name="alat['${countAlat}']['keterangan']" value="${keterangan}"></td>`)
    // $('#tableObatBody').append(`<td><button></td>`)
    $('#tableAlatBody').append("</tr>")
    countAlat++;
})

function deleteAlat(id) {
    $('#tr_alat_'+id).remove();
}

$('#btn-simpan-reservasi').on('click', function(e){
    e.preventDefault();
    var form = document.querySelector("#FormCreateRekamMedis");
    var form_data = new FormData(form);
    var url = "../../rekam_medis/insert.php";
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
            text: "Reservasi Berhasil Disimpan",
            icon: "success",
            showConfirmButton: true,
          }).then((result) => {

          });
        } else {
          Swal.fire({
            title: "Error",
            text: "Reservasi Berhasil Disimpan",
            icon: "error",
            showConfirmButton: true,
          });
        }
      },
    });
})
