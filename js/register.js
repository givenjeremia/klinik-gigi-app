$("#submit_add").on("click", function (e) {
    e.preventDefault();
    var form = document.querySelector("#FormRegister");
    var form_data = new FormData(form);
    var url = "../../backend/auth/register.php";
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
            text: "Register Berhasil, Silahkan Login Kembali",
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
            text: "Pasien Gagal Di Tambahkan",
            icon: "error",
            showConfirmButton: true,
          });
        }
      },
    });
  });