function getData() {
  $("#hasil").html();
  var url = "../../backend/rekam_medis/data.php";
  $.ajax(url, {
    dataType: "json", // type of response data
    timeout: 500, // timeout milliseconds
    success: function (data, status, xhr) {
      // success callback function
      if (data[0].status === "oke") {
        $(".data").remove();
        data.forEach((element, key) => {
          console.log(element.data['Alat'])
          $("#hasil").append("<tr class='data' id='tr_" + key + "'>");
          $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
          $("#tr_" + key).append("<th>" + element.data["nama"] + "</th>");
          $("#tr_" + key).append(
            "<th>" + convertDate(element.data["tanggal_pemeriksaan"]) + "</th>"
          );
          $("#tr_" + key).append("<th>" + element.data["keluhan"] + "</th>");
          $("#tr_" + key).append("<th>" + element.data["diagnosa"] + "</th>");
          $("#tr_" + key).append("<th>" + element.data["tindakan"] + "</th>");
          $("#tr_" + key).append("<th>" + element.data["Alat"] + "</th>");
          $("#tr_" + key).append("<th>" + element.data["Obat"] + "</th>");
          $("#tr_" + key).append(
            "<th>Rp. " + formatRupiah(element.data["total_tarif"]) + "</th>"
          );

          $("#tr_" + key).append(`<th><a href="../../backend/rekam_medis/cetak_resep.php?rekam_medis=${element.data["IdRM"]}&nama_pasien=${element.data["nama"]}" class="btn btn-primary"><i class="fa-solid fa-newspaper"></i></a> </th>`);
          
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
