<?php include '../layouts/session_login.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../layouts/head.php' ?>
    <style>
        .disabled {
            pointer-events: none;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?php include '../layouts/navbar.php' ?>
        <div class="content-wrapper">
            <div class="container-fluid pr-5 pl-5 pt-3">
                <div class="content">
                    <div class="card mt-2 ">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Odontogram</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pasien</th>
                                            <th>Nomor Gigi</th>
                                            <th>Kondisi</th>
                                            <th>Tindakan</th>
                                            <?php if($_SESSION['auth']['role'] != 'perawat'): ?>
                                            <th>Action</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody id="hasil-riwayat">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <script>
        function getData() {
            var dataTable = $("#example1").DataTable();
            if ($.fn.DataTable.isDataTable("#example1")) {
                dataTable.destroy();
            }
            $("#hasil-riwayat").html();
            var url = "../../backend/odontogram/new_all_data.php";
            $.ajax(url, {
                dataType: "json",
                timeout: 5000,
                success: function(data, status, xhr) {
                    console.log(data[0].status)
                    if (data[0].status === "oke") {
                        $(".data").remove();
                        data.forEach((element, key) => {
                            $("#hasil-riwayat").append("<tr class='data' id='tr_" + key + "'>");
                            $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                            $("#tr_" + key).append("<th>" + convertDate(element.data["tanggal"]) + "</th>");
                            $("#tr_" + key).append("<th>" + element.data["NamaPasien"] + "</th>");
                            $("#tr_" + key).append("<th>" + element.data["nomor_gigi"] + "</th>");
                            $("#tr_" + key).append("<th>" + element.data["Kondisi"] + "</th>");
                            $("#tr_" + key).append("<th>" + element.data["Tindakan"] + "</th>");
                            if ('<?= $_SESSION['auth']['role'] ?>' != 'perawat') {         
                                var action = `<th> <a href="#" class="btn btn-danger" onClick="deleteData(` + element.data["id"] + `,` + element.data["rekam_medis_id"] + `)"><i class="fa fa-trash"></i></a></th>`;
                                $("#tr_" + key).append(action);
                            }
                            $("#hasil-riwayat").append("</tr>");
                        });

                        $("#example1")
                            .DataTable({
                                bDestroy: true,
                                responsive: true,
                            });
                    } else {
                        console.log("gagal riwayat")
                        $(".data").remove();

                    }
                },
            });
        }
        getData()
    </script>
    <script>
        function deleteData(id, rekam_medis) {
            var form_data = new FormData();
            form_data.append('odontogram', id)
            var url = "../../backend/odontogram/new_delete.php";
            $.ajax({
                type: "POST",
                url: url,
                data: form_data,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        Swal.fire({
                            title: "Success",
                            text: "Riwayat Odontogram Berhasil Dihapus",
                            icon: "success",
                            showConfirmButton: true,
                        }).then((result) => {
                            getData(rekam_medis)
                            getOdontogram(rekam_medis)
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Riwayat Odontogram Gagal Dihapus",
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                },
            });
        }
    </script>


</body>

</html>