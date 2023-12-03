<?php include '../layouts/session_login.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../layouts/head.php' ?>
    <style>
        .disabled{
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
                        <input type="hidden" id="data_rekam_medis" value="<?= isset($_GET['data']) ? $_GET['data'] : '' ?>">
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
                    <div id="odontograma-content">
                        <div class="row justify-content-center align-content-center mb-3">
                                <div class="col-2">
                                    <h2>Odontograma</h2>
                                </div>
                                <div class="col-2 text-start">
                                    <label for="exampleInputPassword1" class="form-label">Aksi</label>
                                    <select id="cboAksiGigi" name="aksi_gigi" class="select2bs4" style="width: 100%;" required>
                                        <!-- <option value="yellow" key="Caries">Caries</option>
                                        <option value="green" key="Tambalan">Tambalan</option>
                                        <option value="red" key="Brecket">Brecket</option> -->
                                    </select>
                                </div>
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
                                                <th>Posisi</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasil">
        
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
  <script>
        new odontogram({pid:'pid',obj:'odontogram',message:'cmd-message'});
  </script>
  <script>
    function getObat() {
        $("#cboAksiGigi").html();
        $("#cboAksiGigi").append("<option value=''>Pilih Aksi</option>");
        var url = "../../backend/odontogram/get_action.php";
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
    getObat();
  </script>
  <script>
    $('.sorting').click()
  </script>

</body>

</html>