function jadwalData(id) {
  var url = "../../backend/dokter/jadwal/get_data_by_id_dokter.php";
  $('#data-dokter').val(id)
  $.ajax(url, {
    type: "post",
    data: {
      id: id,
    },
    dataType: "json", // type of response data
    timeout: 500, // timeout milliseconds
    success: function (data, status, xhr) {
      // success callback function

      if (data[0].status === "success") {
        $(".data_jadwal").remove();
        data.forEach((element, key) => {

          $("#hasil_jadwal").append("<tr class='data_jadwal' id='tr_jadwal" + key + "'>");
          $("#tr_jadwal" + key).append("<th scope='row'>" + (key + 1) + "</th>");
          $("#tr_jadwal" + key).append("<th>" + element.data["jam"] + "</th>");
          $("#tr_jadwal" + key).append("<th>" + element.data["hari"] + "</th>");
          $("#tr_jadwal" + key).append("<th>" + element.data["kuota_pasien"] + "</th>");
          var action =
            `<th>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalJadwalEdit" onClick="updateJadwalData(` +
            element.data["id"] +
            `)"><i class="fa fa-pen"></i></a> 
                    <a href="#" class="btn btn-danger" onClick="deletJadwaleData(` +
            element.data["id"] +
            `)"><i class="fa fa-trash"></i></a>
                </th>`;
          $("#tr_jadwal" + key).append(action);
          $("#hasil").append("</tr>");
        });

        $("#tableJadwalDokter")
          .DataTable({
            bDestroy: true,
            responsive: true,
          })
      }
    },
  });
}

$("#submit_add_jadwal").on("click", function (e) {
  e.preventDefault();
  $('#data_dokter').val($('#data-dokter').val());
  var form = document.querySelector("#FormTambahJadwalDokter");
  var form_data = new FormData(form);
  var url = "../../backend/dokter/jadwal/insert.php";
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
          text: "Jadwal Dokter Berhasil Ditambahkan",
          icon: "success",
          showConfirmButton: true,
        }).then((result) => {
          $("#close_add_jadwal").click();
          // Reset Value
          for (var key of form_data.keys()) {
            console.log(key)
            form_data.delete(key);
          }
          $("#tableJadwalDokter").DataTable().destroy();
          jadwalData($('#data-dokter').val())
        });
      } else {
        Swal.fire({
          title: "Error",
          text: "Jadwal Dokter Gagal Di Tambahkan",
          icon: "error",
          showConfirmButton: true,
        });
      }
    },
  });
});


// Update
function updateJadwalData(id) {
  var url = "../../backend/dokter/jadwal/get_data_by_id.php";
  $.ajax(url, {
    type: "post",
    data: {
      id: id,
    },
    dataType: "json",
    timeout: 500,
    success: function (data, status, xhr) {
      if (data[0].status == "success") {
        $("#jamEdit").val(data[0].data.jam);
        $("#hariEdit").val(data[0].data.hari);
        $("#kuotaPasienEdit").val(data[0].data.kuota_pasien);
        $("#submit_edit").attr("key", data[0].data.id);
      }
    },
  });
}
// Reserfasi
var hariToIndo = {
  'Sunday': 'Minggu',
  'Monday': 'Senin',
  'Tuesday': 'Selasa',
  'Wednesday': 'Rabu',
  'Thursday': 'Kamis',
  'Friday': 'Jumat',
  'Saturday': 'Sabtu'
};

function jadwalDataAllReservasi(role) {
  var url = "../../backend/reservasi_klinik/jadwal_dokter.php";
  $.ajax(url, {
      type: "GET",
      dataType: "json", // type of response data
      timeout: 500, // timeout milliseconds
      success: function (data, status, xhr) {
        // success callback function
        if (data[0].status === "oke") {
          $(".data_jadwal").remove();
          data[0].data.forEach((element, key) => {

            $("#jadwal-dokter").append("<tr class='data_jadwal' id='tr_jadwal" + key + "'>");
            $("#tr_jadwal" + key).append("<th scope='row'>" + (key + 1) + "</th>");
            $("#tr_jadwal" + key).append("<th>" + element["nama_dokter"] + "</th>");
            $("#tr_jadwal" + key).append("<th>" + element["jam"] + "</th>");
            $("#tr_jadwal" + key).append("<th>" + hariToIndo[element["hari"]] + "</th>");
            $("#tr_jadwal" + key).append("<th>" + element["kuota"] + "</th>");
            if(role != 'perawat'){
              var action =
                `<th>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalJadwalReservasi" onClick="createReservasi(${element["id_jadwal"]},'${element['jam']}','${role}')"><i class="fa fa-book "></i></a> 
                </th>`;
              $("#tr_jadwal" + key).append(action);
            }
            $("#hasil").append("</tr>");
          });
          
          $("#jadwal-dokter")
            .DataTable({
              bDestroy: true,
              responsive: true,
              order: [[3, 'desc']]
            })
        }
      },
  });
}




$('#tanggal_tambah').on('change',function(e){
  var value = $(this).val();
  var id = $('#id_jadwal_dokter_hide').val();
  var jam = $('#jam_jadwal_dokter_hide').val();
  var url_antrian = "../../backend/reservasi_klinik/get_nomor_antrian.php";
  $.ajax(url_antrian, {
    type: "post",
    data: {
      id_jadwal_dokter: id,
      tanggal_reservasi: value
    },
    dataType: "json",
    timeout: 500,
    success: function (data, status, xhr) {
      console.log(data.no_antrian);
      if (data.status == "success") {
     
        const originalTime = new Date(`${data.tanggal}T${jam}`);
        console.log(originalTime)
        var menit_tambah = 0;
        if(data.no_antrian != 1){
          menit_tambah = (parseInt(data.no_antrian) - 1)  * 30
          originalTime.setMinutes(originalTime.getMinutes() + menit_tambah);
        }
        const newTime = originalTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' , hour12: false });
        // console.log(newTime);
        $("#no_antrian").val(data.no_antrian);
        $('#jam').val(newTime);
      }
    },
  });
})

$('#submit_add_reservasi').on('click',function(){
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
    success: function (data) {
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
          getData();
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

function getDataPasien() {
  $.ajax({
      type: "GET",
      url: "../../backend/pasien/data.php",
      dataType: "json",
      success: function(data) {
          $('#pasienReservasi').empty();
          if (data[0].status == 'oke') {
              $('#pasienReservasi').append('<option value="">Pilih Nama Pasien</option>');
              $.each(data, function(i, item) {
                  console.log(item)
                  $('#pasienReservasi').append('<option value="' + item.data["id"] + '">' + item.data["nama"]+'</option>');
              });
          } else {
              $('#pasienReservasi').append('<option value="">Tidak Ada Pasien</option>');
          }
      }
  });
}

function createReservasi(id,jam,role) {
  if(role!= 'pasien'){
    getDataPasien()
    // alert(role)
  //   $.ajax({
  //     type: "GET",
  //     url: "../../backend/pasien/data.php",
  //     dataType: "json",
  //     success: function(data) {
  //         $('#pasienReservasi').empty();
  //         if (data[0].status == 'oke') {
  //             $('#pasienReservasi').append('<option value="">Pilih Nama Pasien</option>');
  //             $.each(data, function(i, item) {
  //                 console.log(item)
  //                 $('#pasienReservasi').append('<option value="' + item.data["id"] + '">' + item.data["nama"]+'</option>');
  //             });
  //         } else {
  //             $('#pasienReservasi').append('<option value="">Tidak Ada Pasien</option>');
  //         }
  //     }
  // });
  }
  var url = "../../backend/reservasi_klinik/data_by_id.php";
  $.ajax(url, {
    type: "post",
    data: {
      id: id,
    },
    dataType: "json",
    timeout: 500,
    success: function (data, status, xhr) {
      if (data[0].status == "success") {
        $('#jadwal_tambah').val(id);
        $("#hari_tambah").val(hariToIndo[data[0].data.hari]);
        $("#no_antrian").val("");
        $('#jam').val("");

        $('#id_jadwal_dokter_hide').val(id);
        $('#jam_jadwal_dokter_hide').val(jam);
      }
    },
  });

}