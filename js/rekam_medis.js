// Get Data
function getAlat() {
  $("#cboAlat").html();
  $("#cboAlat").append("<option value=''>Pilih Alat</option>");
  var url = "../../backend/alat/data.php";
  $.ajax(url, {
    dataType: "json",
    timeout: 5000,
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

function getLayanan() {
  var spesialis = $('#spesialis').val();
  $("#cboLayanan").html();
  $("#cboLayanan").append("<option value=''>Pilih Layanan</option>");
  var url = "../../backend/rekam_medis/data_layanan_hari_ini.php";
  if (spesialis){
    var url = "../../backend/rekam_medis/data_layanan_hari_ini.php?spesialis="+spesialis;
  }
  $.ajax(url, {
    dataType: "json",
    timeout: 5000,
    success: function (data, status, xhr) {
      if (data[0].status === "oke") {
        data.forEach((element, key) => {
          $("#cboLayanan").append(
            `<option value="${element.data["id"]}" harga="${element.data["harga"]}" namaLayanan="${element.data["nama"]}">${element.data["nama"]}</option>`
          );
        });
      }
    },
  });
}
getLayanan();

function getReservasi() {
  $("#cboReservasi").html();
  $("#cboReservasi").append("<option value=''>Pilih Reservasi</option>");
  var url = "../../backend/rekam_medis/data_reservasi_hari_ini.php";
  $.ajax(url, {
    dataType: "json",
    timeout: 5000,
    success: function (data, status, xhr) {
      if (data[0].status === "oke") {
        data.forEach((element, key) => {
          // console.log(element.data['NamaPasien'])
          $("#cboReservasi").append(
            `<option value="${element.data['IdReservasi']}" idJadwal="${element.data['IdJadwal']}" >${element.data['NoAntrian']} - ${element.data['NamaPasien']}</option>`
          );
        });
      }
    },
  });
}
getReservasi();

function getObat() {
  $("#cboObat").html();
  $("#cboObat").append("<option value=''>Pilih Obat</option>");
  var url = "../../backend/obat/data.php";
  $.ajax(url, {
    dataType: "json", // type of response data
    timeout: 5000, // timeout milliseconds
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

function setTotalHarga(harga){
  $("#total-biaya-text").html(formatRupiah(harga));
  $("#total_biaya_input").val(harga);
}


var total_biaya = 0;

var countObat = 1;

$("#btn-tambah-obat").on("click", function(e){
    e.preventDefault()
    var obat_id = $('#cboObat').val()
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
    // $('#tableObatBody').append(`<td><button></td>`)
    $('#tableObatBody').append("</tr>")
    countObat++;
    // Tambah harga
    total_biaya = parseInt(total_biaya) + parseInt(total_harga)
    setTotalHarga(total_biaya)
})

function deleteObat(id) {
    $('#tr_obat_'+id).remove();
}

var countAlat = 1;
$("#btn-tambah-alat").on("click", function(e){
    e.preventDefault()
    var alat_id = $('#cboAlat').val()
    var nama_alat = $('#cboAlat option:selected').attr("namaAlat")
    var harga_alat = parseInt($('#cboAlat option:selected').attr("harga")) * parseInt( $('#pemakaian').val())
    var pemakaian  = $('#pemakaian').val()
    var keterangan  = $('#keterangan').val()
    $('#tableAlatBody').append(`<tr id="tr_alat_${alat_id}">`)
    $('#tableAlatBody').append(`<td>${nama_alat} <input type="hidden" name="alat[${countAlat}][id_alat]" value="${alat_id}"> </td>`)
    $('#tableAlatBody').append(`<td>${pemakaian} <input type="hidden" name="alat[${countAlat}][pemakaian]" value="${pemakaian}"> </td>`)
    $('#tableAlatBody').append(`<td>Rp. ${formatRupiah(harga_alat)} <input type="hidden" name="alat[${countAlat}][harga_alat]" value="${harga_alat}"></td>`)
    $('#tableAlatBody').append(`<td>${keterangan} <input type="hidden" name="alat[${countAlat}][keterangan]" value="${keterangan}"></td>`)
    // $('#tableObatBody').append(`<td><button></td>`)
    $('#tableAlatBody').append("</tr>")
    countAlat++;
    // Tambah harga
    total_biaya = parseInt(total_biaya) + parseInt(harga_alat)
    setTotalHarga(total_biaya)
})

var countTindakan = 1;
$("#btn-tambah-tindakan").on("click", function(e){
    e.preventDefault()
    var layanan_id = $('#cboLayanan').val()
    var nama_layanan = $('#cboLayanan option:selected').attr("namaLayanan")
    var harga_layanan = parseInt($('#cboLayanan option:selected').attr("harga")) * parseInt($('#jumlah_tindakan').val())
    var jumlah  = $('#jumlah_tindakan').val()
    var keterangan_tindakan = $('#keterangan_tindakan').val()
    $('#tableTindakanBody').append(`<tr id="tr_layanan_${layanan_id}">`)
    $('#tableTindakanBody').append(`<td>${nama_layanan} <input type="hidden" name="tindakan[${countTindakan}][id_layanan]" value="${layanan_id}"> </td>`)
    $('#tableTindakanBody').append(`<td>${jumlah} <input type="hidden" name="tindakan[${countTindakan}][jumlah]" value="${jumlah}"> </td>`)
    $('#tableTindakanBody').append(`<td>Rp. ${formatRupiah(harga_layanan)} <input type="hidden" name="tindakan[${countTindakan}][harga_alat]" value="${harga_layanan}"></td>`)
    $('#tableTindakanBody').append(`<td>${keterangan_tindakan} <input type="hidden" name="tindakan[${countTindakan}][keterangan_tindakan]" value="${keterangan_tindakan}"></td>`)
    // $('#tableObatBody').append(`<td><button></td>`)
    $('#tableTindakanBody').append("</tr>")
    countTindakan++;
    // Tambah harga
    total_biaya = parseInt(total_biaya) + parseInt(harga_layanan)
    setTotalHarga(total_biaya)
})

function deleteAlat(id) {
    $('#tr_alat_'+id).remove();
}

// var harga_layanan = 0;
// $("#cboLayanan").on('change', function(){
//   var harga = $('#cboLayanan option:selected').attr("harga")
//   // Tambah harga
//   total_biaya = (parseInt(total_biaya) + parseInt(harga)) - harga_layanan
//   setTotalHarga(total_biaya)
//   // Set Harga Layanan
//   harga_layanan = parseInt(harga)
  
// })

$("#cboReservasi").on('change', function(){
  var jadwal_dokter_id = $('#cboReservasi option:selected').attr("IdJadwal")
  $('#jadwal_dokter_id').val(jadwal_dokter_id)  
})

// var biaya_tindakan = 0
// $("#biaya_tindakan").on("change", function(){
//   var harga = $(this).val() != "" ? parseInt($(this).val().replace(/\./g, '')) : 0;
//   if (biaya_tindakan == 0) {
//     total_biaya = total_biaya+ harga;
//     biaya_tindakan = harga
//   }
//   else{
//     total_biaya= total_biaya - biaya_tindakan + harga;
//     biaya_tindakan = harga

//   }
//   setTotalHarga(total_biaya);
// });

$('#btn-simpan-reservasi').on('click', function(e){
    e.preventDefault();
    var form = document.querySelector("#FormCreateRekamMedis");
    var form_data = new FormData(form);
    var reservasi = $('#reservasi').val();
    var bytes  = CryptoJS.AES.decrypt(reservasi.toString(), 'Klinik-GIGI-APPS');
    var reservasi = bytes.toString(CryptoJS.enc.Utf8);
    form_data.append('reservasi',reservasi)
    var jadwal_dokter_id = $('#dokter').val();
    var bytes  = CryptoJS.AES.decrypt(jadwal_dokter_id.toString(), 'Klinik-GIGI-APPS');
    var jadwal_dokter_id = bytes.toString(CryptoJS.enc.Utf8);
    form_data.append('jadwal_dokter_id',jadwal_dokter_id)
    var url = "../../backend/rekam_medis/insert.php";
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
            showCancelButton: true,
            confirmButtonText: "Kembali",
            cancelButtonText: "Isi Odontrogram",
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../../page/rekam_medis/index.php';
            }
            else{
                window.location.href = '../../page/odontogram/data.php?data='+data.data;
            }
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

