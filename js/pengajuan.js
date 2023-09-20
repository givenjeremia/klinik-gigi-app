function getDataPengajuan() {
    $("#hasil-pengajuan-reservasi").html();
    var url = "../../backend/reservasi_klinik/data_pengajuan.php";
    $.ajax(url, {
        dataType: "json", // type of response data
        timeout: 500, // timeout milliseconds
        success: function (data, status, xhr) {
            // success callback function
            if (data[0].status === "oke") {
                $(".data").remove();
                data[0].data.forEach((element, key) => {
                    $("#hasil-pengajuan-reservasi").append("<tr class='data' id='tr_" + key + "'>");
                    $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                    $("#tr_" + key).append("<th>" + element["NamaDokter"] + "</th>");
                    $("#tr_" + key).append("<th>" + element["NamaPasien"] + "</th>");
                    $("#tr_" + key).append("<th>" + convertDate(element["Tanggal"]) + "</th>");
                    $("#tr_" + key).append("<th>" + element["Jam"] + "</th>");
                    // $("#tr_" + key).append("<th>" + element["Status"] + "</th>");
                    var status =
                    `<th>  
                        <select name="status_pengajuan" id="status_pengajuan" onchange="changeStatusPengajuan(this,'${element['IdReservasi']}','${element['IdJadwal']}','${element['KuotaPasien']}')" class="form-control">
                            <option value="pending" ${element['Status'] === 'pending' ? 'selected' : ''}>Pending</option>
                            <option value="approved" ${element['Status'] === 'approved' ? 'selected' : ''}>Approved</option>
                            <option value="rejected" ${element['Status'] === 'rejected' ? 'selected' : ''}>Rejected</option>
                        </select>
                    </th>`;
                    $("#tr_" + key).append(status);
                    $("#hasil-pengajuan-reservasi").append("</tr>");
                });

            }
            $("#pengajuan-reservasi")
            .DataTable({
                bDestroy: true,
                responsive: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");
        },
    });
}

function changeStatusPengajuan(element, id, IdJadwal, KuotaPasien) {
    var url = "../../backend/reservasi_klinik/update_status.php";
    if(KuotaPasien > 0){
      $.ajax(url, {
        type: "post",
        data: {
          id: id,
          IdJadwal: IdJadwal,
          kuotaPasien: KuotaPasien,
          status: $(element).val(),
        },
        dataType: "json",
        timeout: 500,
        success: function (data, status, xhr) {
          if (data.status == "success") {
              Swal.fire({
                title: "Success",
                text: "Status Berhasil Diubah",
                icon: "success",
                showConfirmButton: true,
              }).then(result => {
                window.location.reload()
              })
            } else {
              Swal.fire({
                title: "Error",
                text: "Status Gagal Di Ubah",
                icon: "error",
                showConfirmButton: true,
              });
            }
        },
      });
    }
    else{
      Swal.fire({
        title: "Error",
        text: "Status Gagal Di Ubah",
        icon: "error",
        showConfirmButton: true,
      });
    }
}