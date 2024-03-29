function getData() {
  // Merupakan ID dari tbody Table Pada Page Dokter dibuat kosong untuk memastikan tidak adanya element sebelum mendapatkan data
  $("#hasil").html();
  // Link Untuk Ke Bagian database atau backendnya
  var url = "../../backend/dokter/data.php";
  // Merupakan Jquery Ajax
  $.ajax(url, {
    dataType: "json",
    timeout: 5000,
    success: function (data, status, xhr) {
      // Jika Setatus Oke tampilkan data (Didapatkan Dari Response JSON pada backend)
      if (data[0].status === "oke") {
        // Remove Class TR untuk memastikan tidak ada nya double
        $(".data").remove();
        // Lakukan Pengulangan untuk menampilkan data yang sudah dikirim
        data.forEach((element, key) => {
          // Generate Key
          $("#hasil").append("<tr class='data' id='tr_" + key + "'>");
          // Generate Data Sesuai Dengan Response Yang Dikirimkan
          $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
          $("#tr_" + key).append("<th>" + element.data["nama"] + "</th>");
          $("#tr_" + key).append("<th>" + element.data["alamat"] + "</th>");
          $("#tr_" + key).append("<th>" + element.data["no_telp"] + "</th>");
          $("#tr_" + key).append(
            "<th>" + element.data["jenis_kelamin"] + "</th>"
          );
          $("#tr_" + key).append("<th>" + element.data["spesialis"] + "</th>");
          // Ditambahkan Action dengan menambahkan onclick Sesuai Dengan Fungsi Action
          var action =
            `<th>
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModalJadwal" onClick="jadwalData(` +
            element.data["id"] +
            `)"><i class="fa fa-calendar"></i></a> 
                  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalEdit" onClick="updateData(` +
            element.data["id"] +
            `)"><i class="fa fa-pen"></i></a> 
                  <a href="#" class="btn btn-danger" onClick="deleteData(` +
            element.data["id"] +
            `)"><i class="fa fa-trash"></i></a>
              </th>`;
          // Tambahkankan Ke Tr untuk action nya
          $("#tr_" + key).append(action);
          $("#hasil").append("</tr>");
        });
        // Merupakan Syntax Untuk Datatable
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
// Panggil getData Setiap membuka Page
getData();

function listSpesialis() {
  // Pastikan CBO Spesialis Kosong
  $("#cboSpesialis").html();
  // Append Data
  $("#cboSpesialis").append("<option value=''>Pilih Spesialis</option>");
  $("#cboSpesialis").append("<option value='umum'>Umum</option>");
  // Url Spesialis Data Pada Database (Konsep sama pada saat mengambil data dokter)
  var url = "../../backend/spesialis/data.php";
  $.ajax(url, {
    dataType: "json",
    timeout: 5000,
    success: function (data, status, xhr) {
      // Pengecekan Status Respnse
      if (data[0].status === "oke") {
        data.forEach((element, key) => {
          // Tambahkan Pada Combobox Jika Berhasul
          $("#cboSpesialis").append(
            `<option value="${element.data["id"]}">${element.data["nama"]}</option>`
          );
        });
      }
    },
  });
}

$("#submit_add").on("click", function (e) {
  // Agar Button Submit tidak terjadi reload
  e.preventDefault();
  // Merupakan Id dari Form Tambah Dokter
  var form = document.querySelector("#FormTambahDokter");
  // Masukan Pada Form Data default dari js
  var form_data = new FormData(form);
  // Merupakan URL letak database insert
  var url = "../../backend/dokter/insert.php";
  // Jquery ajax
  $.ajax({
    type: "POST",
    url: url,
    data: form_data,
    dataType: "json",
    contentType: false,
    processData: false,
    success: function (data) {
      // Pengecekan Jika Success atau tidak 
      if (data.status == "success") {
        // Menampilkan Notif 
        Swal.fire({
          title: "Success",
          text: "Dokter Berhasil Ditambahkan",
          icon: "success",
          showConfirmButton: true,
        }).then((result) => {
          $("#close_add").click();
          // Reset Value
          for (var key of form_data.keys()) {
            form_data.delete(key);
          }
          getData();
          // Reload page jika berhasil
          window.location.reload();
        });
      } else {
        // Menampilkan Notif 
        Swal.fire({
          title: "Error",
          text: "Dokter Gagal Di Tambahkan",
          icon: "error",
          showConfirmButton: true,
        });
      }
    },
  });
});

// Update
function updateData(id) {
  // Generate Spesialis OPTIONAL JIKA MEMBUTUHKAN MENYIMPAN ID PADA TABLE DOKTER KARENA MEMBUTUHKAN SPESIALIS ID
   // Pastikan CBO Spesialis Edit Kosong
   $("#cboSpesialisEdit").html();
   // Append Data
   $("#cboSpesialisEdit").append("<option value=''>Pilih Spesialis</option>");
   $("#cboSpesialisEdit").append("<option value='umum'>Umum</option>");
   // Url Spesialis Data Pada Database (Konsep sama pada saat mengambil data dokter)
   var url = "../../backend/spesialis/data.php";
   $.ajax(url, {
     dataType: "json",
     timeout: 5000,
     success: function (data, status, xhr) {
       // Pengecekan Status Respnse
       if (data[0].status === "oke") {
         data.forEach((element, key) => {
           // Tambahkan Pada Combobox Jika Berhasul
           $("#cboSpesialisEdit").append(
             `<option value="${element.data["id"]}">${element.data["nama"]}</option>`
           );
         });
       }
     },
   });
  // Mengarahkan Kepada URL Dokter untuk mendapatkan data dokter sesuai ID
  var url = "../../backend/dokter/get_data_by_id.php";
  $.ajax(url, {
    type: "post",
    data: {
      id: id,
    },
    dataType: "json",
    timeout: 5000,
    success: function (data, status, xhr) {
      // Jika Sudak Dan status adalah success update value sesuai ID FORM EDIT
      if (data[0].status == "success") {
        $("#namaEdit").val(data[0].data.nama);
        $("#alamatEdit").html(data[0].data.alamat);
        $("#telpEdit").val(data[0].data.no_telp);
        $("#jenisKelaminEdit").val(data[0].data.jenis_kelamin);
        $("#cboSpesialisEdit").val(data[0].data.spesialis_id);
        $("#submit_edit").attr("key", data[0].data.id);
       
        // Update 
      }
    },
  });
}

$("#submit_edit").on("click", function (e) {
  // Mendapatkan ID pada attr button ubah yang sudah di generate sebelumnya
  var id = $(this).attr("key");
  e.preventDefault();
  // Panggil Form dengan ID Form 
  var form = document.querySelector("#FormEditDokter");
  // Generate FormData Dengan melakukan Inisiasi Form data dengan ID
  var form_data = new FormData(form);
  // tambahkan id pada form data dengan menambkan (name,value)
  form_data.append("id", id);
  // URL BE Update
  var url = "../../backend/dokter/update.php";
  // Ajax
  $.ajax({
    type: "POST",
    url: url,
    data: form_data,
    dataType: "json",
    contentType: false,
    processData: false,
    success: function (data, status, xhr) {
      // Cek data Jika berhasil dengan status success maka dokter berhasil diubah
      if (data.status == "success") {
        
        Swal.fire({
          title: "Success",
          text: "Dokter Berhasil Diubah",
          icon: "success",
          showConfirmButton: true,
        }).then((result) => {
          // Reload Page
          window.location.reload();
        });
      } else {
        Swal.fire({
          title: "Error",
          text: "Dokter Gagal Di Ubah",
          icon: "error",
          showConfirmButton: true,
        });
      }
    },
  });
});


function deleteData(id) {
  // Initiate Form Data
  var form_data = new FormData();
  // Tambah id pada form data dengan format (nama, value)
  form_data.append('id', id)
  // Url database atau backend
  var url = "../../backend/dokter/delete.php";
  $.ajax({
      type: "POST",
      url: url,
      data: form_data,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function(data) {
        //Jika response status adalah success maka dokter berhasil dihapus begitu juga sebagainya 
          if (data.status == "success") {
              Swal.fire({
                  title: "Success",
                  text: "Dokter Berhasil Dihapus",
                  icon: "success",
                  showConfirmButton: true,
              }).then((result) => {
                // Reload Halaman
                 window.location.reload();
              });
          } else {
              Swal.fire({
                  title: "Error",
                  text: "Dokter Gagal Dihapus",
                  icon: "error",
                  showConfirmButton: true,
              });
          }
      },
  });
}
