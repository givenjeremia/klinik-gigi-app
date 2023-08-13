function getDataHistoryByUser() {
    $("#hasil-reservasi").html();
    var url = "../../backend/reservasi_klinik/history_by_user.php";
    $.ajax(url, {
        dataType: "json", // type of response data
        timeout: 500, // timeout milliseconds
        success: function (data, status, xhr) {
            // success callback function
            if (data[0].status === "oke") {
                $(".data").remove();
                data[0].data.forEach((element, key) => {
                    $("#hasil-reservasi").append("<tr class='data' id='tr_" + key + "'>");
                    $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                    $("#tr_" + key).append("<th>" + element["NamaDokter"] + "</th>");
                    $("#tr_" + key).append("<th>" + element["Tanggal"] + "</th>");
                    $("#tr_" + key).append("<th>" + element["Jam"] + "</th>");
                    $("#tr_" + key).append("<th>" + element["Status"] + "</th>");
            //         var action =
            //             `<th>  
            //       <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalEdit" onClick="updateData(` +
            //             element.data["id"] +
            //             `)"><i class="fa fa-pen"></i></a> 
            //       <a href="#" class="btn btn-danger" onClick="deleteData(` +
            //             element.data["id"] +
            //             `)"><i class="fa fa-trash"></i></a>
            //   </th>`;
            //         $("#tr_" + key).append(action);
                    $("#hasil-reservasi").append("</tr>");
                });

                $("#history-reservasi")
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

function getAllData() {
    $("#hasil-reservasi").html();
    var url = "../../backend/reservasi_klinik/data.php";
    $.ajax(url, {
        dataType: "json", // type of response data
        timeout: 500, // timeout milliseconds
        success: function (data, status, xhr) {
            // success callback function
            if (data[0].status === "oke") {
                $(".data").remove();
                data[0].data.forEach((element, key) => {
                    $("#hasil-reservasi").append("<tr class='data' id='tr_" + key + "'>");
                    $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                    $("#tr_" + key).append("<th>" + element["NamaDokter"] + "</th>");
                    $("#tr_" + key).append("<th>" + element["NamaPasien"] + "</th>");
                    $("#tr_" + key).append("<th>" + element["Tanggal"] + "</th>");
                    $("#tr_" + key).append("<th>" + element["Jam"] + "</th>");
                    $("#tr_" + key).append("<th>" + element["Status"] + "</th>");
                    $("#hasil-reservasi").append("</tr>");
                });

                $("#history-reservasi")
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



