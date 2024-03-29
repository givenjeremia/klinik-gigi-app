function getData() {
    $("#hasil").html();
    var url = "../../backend/keluhan/data.php";
    $.ajax(url, {
      dataType: "json", // type of response data
      timeout: 5000, // timeout milliseconds
      success: function (data, status, xhr) {
        // success callback function
  
        if (data[0].status === "oke") {
          $(".data").remove();
  
          data.forEach((element, key) => {
            $("#hasil").append("<tr class='data' id='tr_" + key + "'>");
            $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
            $("#tr_" + key).append("<th>" + element.data["nama"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["waktu"] + "</th>");

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
    var form = document.querySelector("#FormTambahKeluhan");
    var form_data = new FormData(form);
    var url = "../../backend/keluhan/insert.php";
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
            text: "Keluhan Berhasil Ditambahkan",
            icon: "success",
            showConfirmButton: true,
          }).then(function(e){
            window.location.reload()
          })
  
        } else {
          Swal.fire({
            title: "Error",
            text: "Kelihan Gagal Di Tambahkan",
            icon: "error",
            showConfirmButton: true,
          });
        }
      },
    });
  });
  
  // Update
  function updateData(id) {
    var url = "../../backend/keluhan/get_data_by_id.php";
    $.ajax(url, {
      type: "post",
      data: {
        id: id,
      },
      dataType: "json",
      timeout: 5000,
      success: function (data, status, xhr) {
        if (data[0].status == "success") {
          $("#namaEdit").val(data[0].data.nama);
          $("#waktuEdit").val(data[0].data.waktu);
          $("#submit_edit").attr("key", data[0].data.id);
        }
      },
    });
  }
  
  $("#submit_edit").on("click", function (e) {
    var id = $(this).attr("key");
    e.preventDefault();
    var form = document.querySelector("#FormEditKeluhan");
    var form_data = new FormData(form);
    form_data.append('id', id);
    var url = "../../backend/keluhan/update.php";
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
            text: "Keluhan terhasil Diubah",
            icon: "success",
            showConfirmButton: true,
          }).then(result => {
            window.location.reload();
          })
        
        } else {
          Swal.fire({
            title: "Error",
            text: "Keluhan Gagal Di Ubah",
            icon: "error",
            showConfirmButton: true,
          });
        }
      },
    });
  });

