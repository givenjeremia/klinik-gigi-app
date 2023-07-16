function getData() {
  $("#hasil").html();
  var url = "../../backend/karyawan/data.php";
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
          $("#tr_" + key).append("<th>" + element.data["alamat"] + "</th>");
          $("#tr_" + key).append("<th>" + element.data["no_telp"] + "</th>");
          var action =
            `<th>  
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalEdit" onClick="updateData(` + element.data["id"] +`)">Update</a> 
                <a href="#" onClick="deleteData(` +element.data["id"] +`)">Delete</a>
            </th>`;
          $("#tr_" + key).append(action);
          $("#hasil").append("</tr>");
        });
      }

      // Datatable
      $("#example1")
        .DataTable({
          responsive: true,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        })
        .buttons()
        .container()
        .appendTo("#example1_wrapper .col-md-6:eq(0)");
    },
  });
}
getData();

$("#submit_add").on("click", function (e) {
  e.preventDefault();
  var form = document.querySelector("#FormTambahKaryawan");
  var form_data = new FormData(form);
  var url = "../../backend/karyawan/insert.php";
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
          text: "Karyawan Berhasil Ditambahkan",
          icon: "success",
          showConfirmButton: true,
        }).then((result) => {
            $("#close_add").click();
            // Reset Value
            for (var key of form_data.keys()) {
                form_data.delete(key);
            }
            getData()
        });
      } else {
        Swal.fire({
          title: "Error",
          text: "Karyawan Gagal Di Tambahkan",
          icon: "error",
          showConfirmButton: true,
        });
      }
    },
  });
});
