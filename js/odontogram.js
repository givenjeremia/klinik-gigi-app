function getData() {
    $("#hasil").html();
    var url = "../../backend/odontogram/data.php";
    $.ajax(url, {
      dataType: "json",
      timeout: 500, 
      success: function (data, status, xhr) {
        if (data[0].status === "oke") {
          $(".data").remove();
          data.forEach((element, key) => {
            $("#hasil").append("<tr class='data' id='tr_" + key + "'>");
            $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
            $("#tr_" + key).append("<th>" + convertDate(element.data["tanggal"])+ "</th>");
            $("#tr_" + key).append("<th>" + element.data["nama"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["nomor_gigi"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["posisi"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["status"] + "</th>");
            // var action =
            //   `<th>  
            //       <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalEdit" onClick="updateData(` +
            //   element.data["id"] +
            //   `)"><i class="fa fa-pen"></i></a> 
            //       <a href="#" class="btn btn-danger" onClick="deleteData(` +
            //   element.data["id"] +
            //   `)"><i class="fa fa-trash"></i></a>
            //   </th>`;
            // $("#tr_" + key).append(action);
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
    var data_pasien = $('#cboRekamMedis').find(':selected').attr('key2')
    e.preventDefault();
    var form = document.querySelector("#FormTambahOdontogram");
    var form_data = new FormData(form);
    form_data.append('pasien',data_pasien)
    var url = "../../backend/odontogram/insert.php";
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
            text: "Odontogram Berhasil Ditambahkan",
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
            text: "Odontogram Gagal Di Tambahkan",
            icon: "error",
            showConfirmButton: true,
          });
        }
      },
    });
  });
  
  // Add
  function formAddData() {
    $("#cboRekamMedis").html("");
    $("#cboRekamMedis").append("<option value=''>Pilih Rekam Medis</option>");
    var url = "../../backend/odontogram/get_rekam_medis.php";
    $.ajax(url, {
      type: "GET",
      dataType: "json",
      timeout: 500,
      success: function (data, status, xhr) {
        if (data[0].status == "oke") {
            data.forEach((element, key) => {
                $("#cboRekamMedis").append(
                  `<option value="${element.data['id']}" key2="${element.data['IdPasien']}">${element.data['id']} - ${element.data['NamaPasien']} - ${convertDate(element.data['tanggal_pemeriksaan'])}</option>`
                );
            });
        }
      },
    });
  }
  formAddData()

  // CBO CHANGE

  $('#cboRekamMedis').on('change', function(){
    
  })


