<?php include '../layouts/session_login.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../layouts/head.php' ?>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?php include '../layouts/navbar.php' ?>
        <div class="content-wrapper">
            <div class="container-fluid pr-5 pl-5 pt-3">
                <div class="content">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalTambah">
                        Add Spesialis
                    </button>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Data Master Spesialis</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hasil">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('create.php') ?>
    <?php include_once('update.php') ?>
    <?php include '../layouts/script.php' ?>
    <!-- Get Data -->
    <script>
        function getData() {
        // Dikosongkan 
            $("#hasil").html();
            // Url BE
            var url = "../../backend/spesialis/data.php";
            // Jquery Ajax
            $.ajax(
            url, {
            dataType: "json", 
            timeout: 500,
            success: function (data, status) {
                console.log(status);
                if (data[0].status === "oke") {
                $(".data").remove();
                // Lopping
                data.forEach((element, key) => {
                    $("#hasil").append("<tr class='data' id='tr_" + key + "'>");
                    $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                    $("#tr_" + key).append("<th>" + element.data["nama"] + "</th>");
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
                // Datatable
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
  
    </script>
    <!-- Insert Data -->
    <script>
        
    </script>
    <script src="../../js/spesialis.js"></script>
</body>

</html>