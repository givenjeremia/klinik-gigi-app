function getData() {
    $("#hasil").html();
    var url = "../../backend/layanan/data.php";
    $.ajax(url, {
      dataType: "json",
      timeout: 500,
      success: function (data, status, xhr) {
        if (data[0].status === "oke") {
          $(".data").remove();
          data.forEach((element, key) => {
            $("#hasil").append("<tr class='data' id='tr_" + key + "'>");
            $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
            $("#tr_" + key).append("<th>" + element.data["nama"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["jenis"] + "</th>");
            $("#tr_" + key).append("<th>Rp. " + formatRupiah(element.data["harga"]) + "</th>");
            $("#tr_" + key).append("<th>" + element.data["hari_dokter"] + "</th>");
            if (data[0].role != 'pasien'){
              var action =
                `<th>  
                      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalEdit" onClick="updateData(` +element.data["id"] +`)"><i class="fa fa-pen"></i></a> 
                      <a href="#" class="btn btn-danger" onClick="deleteData(` +element.data["id"] +`)"><i class="fa fa-trash"></i></a>
                  </th>`;
              $("#tr_" + key).append(action);
            }
            $("#hasil").append("</tr>");
          });
        }
      },
    });
  }
  getData();
  
  $("#submit_add").on("click", function (e) {
    e.preventDefault();
    var form = document.querySelector("#FormTambahLayanan");
    var form_data = new FormData(form);
    var url = "../../backend/layanan/insert.php";
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
            text: "Layanan Berhasil Ditambahkan",
            icon: "success",
            showConfirmButton: true,
          }).then((result) => {
            $("#close_add").click();
            // Reset Value
            for (var key of form_data.keys()) {
              form_data.delete(key);
            }
            // Datatable
            $("#example1").DataTable().destroy();
            $("#example1")
              .DataTable({
                responsive: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
              })
              .buttons()
              .container()
              .appendTo("#example1_wrapper .col-md-6:eq(0)");
            getData();
          });
        } else {
          Swal.fire({
            title: "Error",
            text: "Layanan Gagal Di Tambahkan",
            icon: "error",
            showConfirmButton: true,
          });
        }
      },
    });
  });
  
  // Update
  function updateData(id) {
    var url = "../../backend/layanan/get_data_by_id.php";
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
          $("#jenisEdit").val(data[0].data.jenis);
          $("#kategoriEdit").val(data[0].data.kategori);
          $("#hargaEdit").val(formatRupiah(data[0].data.harga));
          $("#submit_edit").attr("key", data[0].data.id);
        }
      },
    });
  }
  
  $("#submit_edit").on("click", function (e) {
    var id = $(this).attr("key");
    e.preventDefault();
    var form = document.querySelector("#FormEditLayanan");
    var form_data = new FormData(form);
    form_data.append('id', id);
    var url = "../../backend/layanan/update.php";
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
            text: "Alat Berhasil Diubah",
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
          })
        
        } else {
          Swal.fire({
            title: "Error",
            text: "Alat Gagal Di Ubah",
            icon: "error",
            showConfirmButton: true,
          });
        }
        getData();
      },
    });
  });