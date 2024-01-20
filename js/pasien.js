function getData() {
    $("#hasil").html();
    var url = "../../backend/pasien/data.php";
    $.ajax(url, {
      dataType: "json", // type of response data
      timeout: 500, // timeout milliseconds
      success: function (data, status, xhr) {
        // success callback function
  
        if (data[0].status === "oke") {
          $(".data").remove();
  
          data.forEach((element, key) => {
            $("#hasil").append("<tr class='data' id='tr_" + key + "'>");
            $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
            $("#tr_" + key).append("<th>" + element.data["nama"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["usia"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["tempat_tanggal_lahir"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["alamat"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["no_telp"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["tanggal_daftar"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["jenis_kelamin"] + "</th>");
            var action =
              `<th>  
                  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalEdit" onClick="updateData(` +
              element.data["id"] +
              `)"><i class="fa fa-pen"></i></a> 
                  <a href="#" class="btn btn-danger" onClick="deleteData(` +
              element.data["id"] +
              `)"><i class="fa fa-trash"></i></a>
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
  getData();
  
  $("#submit_add").on("click", function (e) {
    e.preventDefault();
    var form = document.querySelector("#FormTambahPasien");
    var form_data = new FormData(form);
    var url = "../../backend/pasien/insert.php";
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
            text: "Pasien Berhasil Ditambahkan",
            icon: "success",
            showConfirmButton: true,
          }).then((result) => {
            $("#close_add").click();
            // Reset Value
            for (var key of form_data.keys()) {
              form_data.delete(key);
            }
            getData();
            window.location.reload();
          });
        } else {
          Swal.fire({
            title: "Error",
            text: "Pasien Gagal Di Tambahkan",
            icon: "error",
            showConfirmButton: true,
          });
        }
      },
    });
  });
  
  // Update
  function updateData(id) {
    var url = "../../backend/pasien/get_data_by_id.php";
    $.ajax(url, {
      type: "post",
      data: {
        id: id,
      },
      dataType: "json",
      timeout: 500,
      success: function (data, status, xhr) {
        if (data[0].status == "success") {
          $("#namaEdit").val(data[0].data.nama);
          $("#usiaEdit").val(data[0].data.usia);
          $("#tempatTanggalLahirEdit").val(data[0].data.tempat_tanggal_lahir);
          $("#alamatEdit").val(data[0].data.alamat);
          $("#telpEdit").val(data[0].data.no_telp);
          $("#tanggalDaftarEdit").val(data[0].data.tanggal_daftar);
          $("#jenisKelaminEdit").val(data[0].data.jenis_kelamin);
          $("#submit_edit").attr("key", data[0].data.id);
        }
      },
    });
  }
  
  $("#submit_edit").on("click", function (e) {
    var id = $(this).attr("key");
    e.preventDefault();
    var form = document.querySelector("#FormEditPasien");
    var form_data = new FormData(form);
    form_data.append('id', id);
    var url = "../../backend/pasien/update.php";
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
            text: "Pasien Berhasil Diubah",
            icon: "success",
            showConfirmButton: true,
          }).then(result => {
            $("#close_edit").click();
            // Reset Value
            for (var key of form_data.keys()) {
              form_data.delete(key);
            }
            $("#example1").DataTable().destroy();
            getData();
            window.location.reload();
          })
        
        } else {
          Swal.fire({
            title: "Error",
            text: "Pasien Gagal Di Ubah",
            icon: "error",
            showConfirmButton: true,
          });
        }
        getData();
      },
    });
  });

