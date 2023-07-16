$("#btn-login").on("click", function (e) {
  e.preventDefault();
  var form = document.querySelector("#LoginPageForm");
  var form_data = new FormData(form);
  var url = "../../backend/auth/login.php";
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
          text: "Login Berhasil",
          icon: "success",
          showConfirmButton: true,
        }).then((result) => {
        //   window.location.href = "/";
        });
      } else {
        Swal.fire({
          title: "Error",
          text: "Login Gagal",
          icon: "error",
          showConfirmButton: true,
        });
      }
    },
  });
});
