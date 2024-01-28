
$("#submit_add").on("click", function (e) {
    e.preventDefault();
    var form = document.querySelector("#FormTambahSpesialis");
    // FormData
    var form_data = new FormData(form);
    // url datbase
    var url = "../../backend/spesialis/insert.php";
    // Ajax Jquery
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
            text: "Spesialis Berhasil Ditambahkan",
            icon: "success",
            showConfirmButton: true,
          })
          window.location.reload();
          // $("#close_add").click();
          // for (var key of form_data.keys()) {
          //   console.log(key)
          //     form_data.delete(key);
          // }
          //  $("#example1").DataTable().destroy();
          //   getData();
          //   console.log('Complate')
        } else {
          Swal.fire({
            title: "Error",
            text: "Spesialis Gagal Di Tambahkan",
            icon: "error",
            showConfirmButton: true,
          });
        }
      },
    });
  });
  
  // Update
  function updateData(id) {

    var url = "../../backend/spesialis/get_data_by_id.php";
    $.ajax(
      url, {
      type: "post",
      data: {
        id: id,
      },
      dataType: "json",
      timeout: 500,
      success: function (data, status, xhr) {
        if (data[0].status == "success") {
          $("#namaEdit").val(data[0].data.nama);
          $("#submit_edit").attr("key", data[0].data.id);
        }
      },
    });
  }
  
  $("#submit_edit").on("click", function (e) {
    var id = $(this).attr("key");
    e.preventDefault();
    // Form data 
    var form = document.querySelector("#FormEditSpesialis");
    var form_data = new FormData(form);
    // 
    form_data.append('id', id);
    // Url Update
    var url = "../../backend/spesialis/update.php";
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
            text: "Spesialis terhasil Diubah",
            icon: "success",
            showConfirmButton: true,
          }).then(result => {
            window.location.reload();

          })
        
        } else {
          Swal.fire({
            title: "Error",
            text: "Spesialis Gagal Di Ubah",
            icon: "error",
            showConfirmButton: true,
          });
        }
        getData();
      },
    });
  });

