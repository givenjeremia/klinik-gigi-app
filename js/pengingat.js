function getPengingat(pengingat) {
    $("#hasil-reservasi").html();
    var url = ''
    if(pengingat == 'besok'){
        url = "../../backend/pengingat/besok.php";
    }
    else if(pengingat == 'terlewati'){
        url = "../../backend/pengingat/terlewati.php";
    }
    else{
        url = "../../backend/pengingat/hari_ini.php";
    }
    var dataTable = $("#example1").DataTable();
    if ($.fn.DataTable.isDataTable("#example1")) {
        dataTable.destroy();
    }

    $.ajax(url, {
      dataType: "json", // type of response data
      timeout: 500, // timeout milliseconds
      success: function (data, status, xhr) {
        // success callback function
        $(".data").remove();
        if (data[0].status === "oke") {
          data[0].data.forEach((element, key) => {
            $("#hasil").append("<tr class='data' id='tr_" + key + "'>");
            $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
            $("#tr_" + key).append("<th>" + element["NoAntrian"] + "</th>");
            $("#tr_" + key).append("<th>" + element["NamaDokter"] + "</th>");
            $("#tr_" + key).append("<th>" + convertDate(element["Tanggal"]) + "</th>");
            $("#tr_" + key).append("<th>" + element["Jam"] + "</th>");
            $("#hasil").append("</tr>");
          });
  
   
        }
        $("#example1")
        .DataTable({
          responsive: true,
        })
      },
    });
}
getPengingat('hari_ini')

$("#pilih_hari").on('change', function(){
    var value = $(this).val();
    getPengingat(value)
})