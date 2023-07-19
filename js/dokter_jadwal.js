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