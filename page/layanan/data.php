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

                    <!-- <p>Rp</p> -->
                    <div class="row" id="layanan-content">
                        <!-- <div class="col-lg-3 col-6">
                            <div class="small-box">
                                <div class="inner">
                                    <h3>Nama</h3>
                                    <p>Jenis</p>
                                    <p>Spesialis</p>                      
                                    
                                </div>
                                <div  class="small-box-footer text-dark text-bold">Rp. 50.000</div>
                            </div>

                        </div> -->


                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_rupiah.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <script>
        $(document).on('input', '.format-rupiah', function () {
            $(this).val(formatRupiah(this.value));
        })
    </script>
    <script>
        function getDataNew() {
            $("#layanan-content").html();
            var url = "../../backend/layanan/data.php";
            $.ajax(url, {
                dataType: "json",
                timeout: 500,
                success: function (data, status, xhr) {
                    if (data[0].status === "oke") {
                        data.forEach((element, key) => {
                            var element =`
                            <div class="col-lg-3 col-6">
                                <div class="small-box">
                                    <div class="inner">
                                        <h3>${element.data["nama"]}</h3>
                                        <p>Jenis : ${element.data["jenis"]}</p>
                                        <p>Spesialis : ${element.data["spesialis"]}</p>                      
                                    </div>
                                    <div  class="small-box-footer text-dark text-bold">Rp. ${formatRupiah(element.data["harga"])}</div>
                                </div>
                            </div>
                            `
                            $("#layanan-content").append(element);
                        });
                    }
                },
            });
        }
        getDataNew();
    </script>
</body>

</html>