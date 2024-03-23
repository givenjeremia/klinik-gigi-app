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
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Rekam Medis</label>
                        <input type="hidden" id="data_rekam_medis"
                            value="<?= isset($_GET['data']) ? $_GET['data'] : '' ?>">
                        <?php if(!isset($_GET['data'])): ?>
                        <select id="cboRekamMedis" name="rekam_medis" class="select2bs4" style="width: 100%;" required>
                            <option value="">Pilih Rekam Medis</option>
                            <option value="laki-laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <?php else:?>

                        <h5>Rekam Medis : <span><?= $_GET['data'] ?></span></h5>
                        <!-- <h5>Pasien : <span id="data-pasien"><?= $_GET['data'] ?></span></h5>
                        <h5>Tanggal : <span id="data-tanggal"><?= $_GET['data'] ?></span></h5> -->
                        <?php endif;?>
                    </div>
                    <div id="odontograma-content" class="d-none">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="d-blok">Nama</label>
                                            <h4 id="nama_label">Nama</h4>
                             
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="d-blok">Alamat</label>
                                            <h4 id="alamat_label">Alamat</h4>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="d-blok">Usia</label>
                                            <h4 id="usia_label">Usia</h4>
                                            <input type="hidden" id="usia_value">

                             
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="d-blok">Tanggal Lahir</label>
                                            <h4 id="tanggal_lahir_label">Tanggal Lahir</h4>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="d-blok">Telepon</label>
                                            <h4 id="telepon_label">Telepon</h4>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="d-blok">Jenis Kelamin</label>
                                            <h4 id="jenis_kelamin_label">Jenis Kelamin</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center align-content-center mb-3">
                            <div class="col-2">
                                <h2>Odontograma</h2>
                            </div>
                            <?php if($_SESSION['auth']['role'] != 'perawat') : ?>
                            <div class="col-2 text-start">
                                <label for="exampleInputPassword1" class="form-label">Aksi</label>
                                <select id="cboAksiGigi" name="aksi_gigi" class="select2bs4" style="width: 100%;"
                                    required>
                                    <!-- <option value="yellow" key="Caries">Caries</option>
                                        <option value="green" key="Tambalan">Tambalan</option>
                                        <option value="red" key="Brecket">Brecket</option> -->
                                </select>
                            </div>
                            <?php endif;?>
                        </div>
                        <div id="odontograma-wrapper" class=" justify-content-center align-content-center text-center">

                            <div class="pid-odontogram"></div>
                            <div class="cmd btn-cmd" style="width:100%"></div>
                        </div>
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
                                                <th>Keterangan</th>
                                                <?php if($_SESSION['auth']['role'] != 'perawat') :?>
                                                <th>Action</th>
                                                <?php endif;?>
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
    </div>

    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <script src="../../js/odontogram_3.js"></script>
    <!-- Kondisi -->
    <script>
        function getKondisi() {
            $("#cboAksiGigi").html();
            $("#cboAksiGigi").append("<option value=''>Pilih Kondisi</option>");
            var url = "../../backend/odontogram/get_kondisi.php";
            $.ajax(url, {
                dataType: "json", // type of response data
                timeout: 500, // timeout milliseconds
                success: function (data, status, xhr) {
                    if (data[0].status === "oke") {
                        data.forEach((element, key) => {
                            $("#cboAksiGigi").append(
                                `<option value="${element.data["id"]}" format="${element.data["format"]}" key="${element.data["key_data"]}">${element.data["nama"]}</option>`
                            );
                        });
                    }
                },
            });
        }
        getKondisi();
    </script>
    <!-- Riwayat -->
    <script>
        function getData(data) {
            var dataTable = $("#example1").DataTable();
            if ($.fn.DataTable.isDataTable("#example1")) {
                dataTable.destroy();
            }
            $("#hasil-riwayat").html();
            var url = "../../backend/odontogram/new_riwayat.php?id=" + data;
            $.ajax(url, {
                dataType: "json",
                timeout: 500,
                success: function (data, status, xhr) {
                    console.log(data[0].status)
                    if (data[0].status === "oke") {
                        $(".data").remove();
                        data.forEach((element, key) => {
                            $("#hasil-riwayat").append("<tr class='data' id='tr_" + key + "'>");
                            $("#tr_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                            $("#tr_" + key).append("<th>" + convertDate(element.data["tanggal"]) +"</th>");
                            $("#tr_" + key).append("<th>" + element.data["NamaPasien"] + "</th>");
                            $("#tr_" + key).append("<th>" + element.data["nomor_gigi"] + "</th>");
                            $("#tr_" + key).append("<th>" + element.data["Kondisi"] + "</th>");
                            $("#tr_" + key).append("<th>" + element.data["Tindakan"] + "</th>");
                            $("#tr_" + key).append("<th>" + element.data["Keterangan"] + "</th>");

                            if('<?= $_SESSION['auth']['role'] ?>' != 'perawat'){
                                var action =`<th> <a href="#" class="btn btn-danger" onClick="deleteData(` + element.data["id"] +`,` + element.data["rekam_medis_id"] + `)"><i class="fa fa-trash"></i></a></th>`;
                                $("#tr_" + key).append(action);
                            }
                            $("#hasil-riwayat").append("</tr>");
                        });

                        $("#example1")
                            .DataTable({
                                bDestroy: true,
                                responsive: true,
                            });
                    }
                    else{
                        console.log("gagal riwayat")
                        $(".data").remove();

                    }
                },
            });
        }

    </script>
    <!-- getProfile -->
    <script>
       
        function getProfil(data) {
            var url = "../../backend/odontogram/profil.php?id=" + data;
            $.ajax(url, {
                dataType: "json",
                timeout: 500,
                success: function (data, status, xhr) {
               
                    var usia = 0;
                    if (data[0].status === "oke") {
                        data.forEach((element, key) => {
                            $('#nama_label').html(element.data["NamaPasien"])
                            $('#usia_label').html(element.data["UsiaPasien"])
                            $('#usia_value').val(element.data["UsiaPasien"])
                            usia = element.data["UsiaPasien"]
                            $('#alamat_label').html(element.data["alamatPasien"])
                            $('#tanggal_lahir_label').html(element.data["ttlPasien"])
                            $('#jenis_kelamin_label').html(element.data["jenisKelaminPasien"])
                            $('#telepon_label').html(element.data["telpPasien"])
                            // console.log(usia)
                        });
                        console.log(usia)
                        return usia

                    }
                    else{
                        console.log("gagal riwayat")
                        return 0
                    }
                },
            });
        }

    </script>
    <script>
        function deleteData(id,rekam_medis){
            var form_data = new FormData();
            form_data.append('odontogram',id)
            var url = "../../backend/odontogram/new_delete.php";
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
                        text: "Riwayat Odontogram Berhasil Dihapus",
                        icon: "success",
                        showConfirmButton: true,
                    }).then((result) => {
                        getData(rekam_medis)
                        getOdontogram(rekam_medis,0)
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
    <!-- Get Rekam Medis Data -->
    <?php if(!isset($_GET['data'])) : ?>
    <script>
        function formAddData() {
            $("#cboRekamMedis").html("");
            $("#cboRekamMedis").append("<option value=''>Pilih Rekam Medis</option>");
            var url = "../../backend/odontogram/get_rekam_medis.php";
            $.ajax(url, {
            type: "GET",
            dataType: "json",
            timeout: 500,
            success: function (data, status, xhr) {
                if (data[0].status == "oke") {
                    data.forEach((element, key) => {
                        $("#cboRekamMedis").append(
                        `<option value="${element.data['id']}" usiaPasien="${element.data['UsiaPasien']}" key2="${element.data['IdPasien']}">${element.data['id']} - ${element.data['NamaPasien']} - ${convertDate(element.data['tanggal_pemeriksaan'])}</option>`
                        );
                    });
                    // Add Input

                }
            },
            });
        }
        formAddData()
        $('#cboRekamMedis').on('change', function(){
            var value = $(this).val();
            if (value !== ''){
                getProfil(value)
                getData(value)
                getOdontogram(value,0)
                $('#odontograma-content').removeClass('d-none')
            }
            else{
                $('#odontograma-content').addClass('d-none')
            }
        })
    </script>
    <?php else:?>
        <script>
            if($('#data_rekam_medis').val() !== ""){
                console.log('masuk')
                getData($('#data_rekam_medis').val())
                var url = "../../backend/odontogram/profil.php?id=" + $('#data_rekam_medis').val();
                $.ajax(url, {
                    dataType: "json",
                    timeout: 500,
                    success: function (data, status, xhr) {
                
                        var usia = 0;
                        if (data[0].status === "oke") {
                            data.forEach((element, key) => {
                                $('#nama_label').html(element.data["NamaPasien"])
                                $('#usia_label').html(element.data["UsiaPasien"])
                                $('#usia_value').val(element.data["UsiaPasien"])
                                usia = element.data["UsiaPasien"]
                                $('#alamat_label').html(element.data["alamatPasien"])
                                $('#tanggal_lahir_label').html(element.data["ttlPasien"])
                                $('#jenis_kelamin_label').html(element.data["jenisKelaminPasien"])
                                $('#telepon_label').html(element.data["telpPasien"])
                                getOdontogram($('#data_rekam_medis').val(),usia)
                                // console.log(usia)
                            });
                            console.log(usia)
             

                        }
                        else{
                            console.log("gagal riwayat")

                        }
                    },
                });
                
                console.log('===aa')
                $('#odontograma-content').removeClass('d-none')
            }
        </script>
    <?php endif; ?>

</body>

</html>