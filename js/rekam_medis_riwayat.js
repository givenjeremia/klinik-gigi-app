function getDetailPasien(){
    var id_pasien = $('#id_pasien').val();
    if(id_pasien != ''){
        var url = "../../backend/pasien/get_data_by_id.php";
        $.ajax(url, {
          type: "post",
          data: {
            id: id_pasien,
          },
          dataType: "json",
          timeout: 500,
          success: function (data, status, xhr) {
            if (data[0].status == "success") {
              $("#nama_pasien").html(data[0].data.nama)
              $("#tanggal_lahir_pasien").html(data[0].data.tempat_tanggal_lahir)
              $("#no_telepon_pasien").html(data[0].data.no_telp)
              $("#alamat_pasien").html(data[0].data.alamat)
              $("#jenis_kelamin_pasien").html(data[0].data.jenis_kelamin)
              $("#umur_pasien").html(data[0].data.usia+ ' Tahun')
            }
            else{
                window.location.href ='/'
            }
          },
        });
    }
    else{
        window.location.href ='/'
    }
}
getDetailPasien();

function getRekamMedisPasien(){
    var id_pasien = $('#id_pasien').val();
    if(id_pasien != ''){
        var url = "../../backend/rekam_medis/get_data_by_id_pasien.php";
        $.ajax(url, {
          type: "post",
          data: {
            id: id_pasien,
          },
          dataType: "json",
          timeout: 500,
          success: function (data, status, xhr) {
            if (data[0].status === "success") {
                $(".data").remove();
                data.forEach((element, key) => {
                  $("#hasil").append("<tr class='data' id='tr_" + key + "'>");
                  $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                  $("#tr_" + key).append(
                    "<th>" + convertDate(element.data["tanggal_pemeriksaan"]) + "</th>"
                  );
                  $("#tr_" + key).append("<th>" + element.data["keluhan"] + "</th>");
                  $("#tr_" + key).append("<th>" + element.data["diagnosa"] + "</th>");
        
                  $("#tr_" + key).append(`
                  <th>
                  <button onclick="detailRekamMedis(${element.data["id"]})" data-toggle="modal" data-target="#modal-lg" class="btn btn-info"><i class="fa fa-info"></i></button> 
                  <a href="'../../../../page/odontogram/index.php?data=${element.data["id"]}"  target="_blank" class="btn btn-secondary"><i class="fa fa-tooth"></i></a> 
                  </th>
                  `);
                  
                  $("#hasil").append("</tr>");
                });
        
                $("#example1")
                  .DataTable({
                    bDestroy: true,
                    responsive: true,
                  })
                  .buttons()
                  .container()
                  .appendTo("#example1_wrapper .col-md-6:eq(0)");
              }
          },
        });
    }
    else{
        window.location.href ='/'
    }
}
getRekamMedisPasien();

function detailRekamMedis(id){

}