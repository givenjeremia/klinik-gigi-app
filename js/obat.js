function getData() {
    $("#hasil").html();
    var url = "../../backend/obat/data.php";
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
            $("#tr_" + key).append("<th>" + element.data["kategori"] + "</th>");
            $("#tr_" + key).append("<th>" +  convertDate(element.data["tgl_exp"]) + "</th>");
            $("#tr_" + key).append("<th>" + element.data["stok"] + "</th>");
            $("#tr_" + key).append("<th>" + element.data["jenis"] + "</th>");
            $("#tr_" + key).append("<th>Rp. " + formatRupiah(element.data["harga"]) + "</th>");
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
    var form = document.querySelector("#FormTambahObat");
    var form_data = new FormData(form);
    var url = "../../backend/obat/insert.php";
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
            text: "Obat Berhasil Ditambahkan",
            icon: "success",
            showConfirmButton: true,
          })
          $("#close_add").click();
          for (var key of form_data.keys()) {
            console.log(key)
              form_data.delete(key);
          }
           $("#example1").DataTable().destroy();
            getData();
            console.log('Complate')
        } else {
          Swal.fire({
            title: "Error",
            text: "Obat Gagal Di Tambahkan",
            icon: "error",
            showConfirmButton: true,
          });
        }
      },
    });
  });
  
  // Update
  function updateData(id) {
    var url = "../../backend/obat/get_data_by_id.php";
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
          $("#kategoriEdit").val(data[0].data.kategori);
          $("#tglExpEdit").val(data[0].data.tgl_exp);
          $("#stokEdit").val(data[0].data.stok);
          $("#jenisEdit").val(data[0].data.jenis);
          $("#hargaEdit").val(formatRupiah(data[0].data.harga));
          $("#submit_edit").attr("key", data[0].data.id);
        }
      },
    });
  }
  
  $("#submit_edit").on("click", function (e) {
    var id = $(this).attr("key");
    e.preventDefault();
    var form = document.querySelector("#FormEditObat");
    var form_data = new FormData(form);
    form_data.append('id', id);
    var url = "../../backend/obat/update.php";
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
            text: "Obat terhasil Diubah",
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
            text: "Obat Gagal Di Ubah",
            icon: "error",
            showConfirmButton: true,
          });
        }
        getData();
      },
    });
  });

