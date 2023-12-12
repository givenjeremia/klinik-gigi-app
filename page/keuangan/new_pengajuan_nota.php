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
                <?php if(isset($_GET['nota'])) : ?>
                <input id="nota" type="hidden" value="<?= str_replace(' ', '+', $_GET['nota'])  ?>">
                <input id="pasien" type="hidden" value="<?= str_replace(' ', '+', $_GET['pasien'])  ?>">
                <input id="rekam_medis" type="hidden" value="<?= str_replace(' ', '+', $_GET['rekam-medis'])  ?>">
                <input id="total_tarif" type="hidden" value="<?= str_replace(' ', '+', $_GET['total-tarif'])  ?>">
                <?php else: ?>
                    <p>Nota parameter is not set. Closing the page...</p>
                    <script>
                        window.close();
                    </script>
                <?php endif; ?>
                <div class="content">
                    <form id="FormPengajuanNota" method="POST">
                        <h3>Pengajuan Nota</h3>
                        <!-- Keterangan -->
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3 class="card-title">Keterangan</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mx-5">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mx-5">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nota</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nota" id="nota-input" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col mx-5">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Pasien</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="pasien-input" class="form-control" name="pasien_nama" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mx-5">
                                      
                                    </div>
                                </div>          
                            </div>
                        </div>
                        <!-- Tindakan -->
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3 class="card-title">Tindakan</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="daftar-tindakan" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tindakan</th>
                                                <th>Jumlah</th>
                                                <th>Catatan</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasil-daftar-tindakan">
    
                                        </tbody>
                                      
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Alat -->
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3 class="card-title">Alat</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="daftar-alat" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Alat</th>
                                                <th>Jumlah</th>
                                                <th>Keterangan</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasil-daftar-alat">
    
                                        </tbody>
                                      
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                         <!-- Obat -->
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3 class="card-title">Obat</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="daftar-Obat" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>No</th>
                                                <th>Obat</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasil-daftar-obat">
    
                                        </tbody>
                                      
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Total -->
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-auto col-form-label">Metode Pembayaran</label>
                                            <div class="col">
                                                <select name="jenis_pembayaran" id="jenisPembayaranVerif" class="form-control">
                                                    <option value="lunas">Lunas</option>
                                                    <option value="cicilan">Cicilan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mx-5">
                                        <div class="form-group row">
                                            <h3 class=" text-bold">Total : Rp. <span id="total-harga">9.000.000</span></h3>
                                            <input type="hidden" name="total-harga" id="total-harga-input">
                                        </div>
                                    </div>
                                </div>      
                                <button id="btn-verif" class=" btn btn-primary w-100">VERIF</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <?php include '../layouts/format_rupiah.php' ?>
    <!-- Get TIndakan Funtion  -->
    <script>
        function getTindakan(id){
            $("#hasil-daftar-tindakan").html();
            var url = "../../backend/keuangan/get_tindakan_by_rm_id.php?rekam_medis="+id;
            $.ajax(url, {
                dataType: "json",
                timeout: 500,
                success: function (data, status, xhr) {
                    // success callback function
                    if (data[0].status === "oke") {
                    $(".data-daftar-tindakan").remove();
            
                    data.forEach((element, key) => {
                        $("#hasil-daftar-tindakan").append("<tr class='data-daftar-tindakan' id='tr_daftar-tindakan_" + key + "'>");
                        $("#tr_daftar-tindakan_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                        $("#tr_daftar-tindakan_" + key).append("<th>" + element.data["nama"] + "</th>");
                        $("#tr_daftar-tindakan_" + key).append("<th>" + element.data["jumlah"] + "</th>");
                        $("#tr_daftar-tindakan_" + key).append("<th>" + element.data["catatan"] + "</th>");
                        $("#tr_daftar-tindakan_" + key).append("<th>Rp. " +formatRupiah(element.data["harga"]) + "</th>");
                        $("#hasil-daftar-tindakan").append("</tr>");
                    });
                    
                    $("#daftar-tindakan")
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
    </script>
       <!-- Get Alat Funtion  -->
    <script>
        function getAlat(id){
            $("#hasil-daftar-tindakan").html();
            var url = "../../backend/keuangan/get_alat_by_rm_id.php?rekam_medis="+id;
            $.ajax(url, {
                dataType: "json",
                timeout: 500,
                success: function (data, status, xhr) {
                    // success callback function
                    if (data[0].status === "oke") {
                    $(".data-daftar-alat").remove();
            
                    data.forEach((element, key) => {
                        $("#hasil-daftar-alat").append("<tr class='data-daftar-alat' id='tr_daftar-alat_" + key + "'>");
                        $("#tr_daftar-alat_" + key).append("<th scope='row'>" + (key + 1) + "</th>");
                        $("#tr_daftar-alat_" + key).append("<th>" + element.data["NamaAlat"] + "</th>");
                        $("#tr_daftar-alat_" + key).append("<th>" + element.data["jumlah_pemakaian"] + "</th>");
                        $("#tr_daftar-alat_" + key).append("<th>" + element.data["keterangan"] + "</th>");
                        $("#tr_daftar-alat_" + key).append("<th>Rp. " +formatRupiah(element.data["harga"]) + "</th>");
                        $("#hasil-daftar-tindakan").append("</tr>");
                    });
                    
                    $("#daftar-tindakan")
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
    </script>
    <!-- Get Obat Funtion -->
    <script>
         function getObat(id){
            $("#hasil-daftar-obat").html();
            var url = "../../backend/keuangan/get_obat_by_rm_id.php?rekam_medis="+id;
            $.ajax(url, {
                dataType: "json",
                timeout: 500,
                success: function (data, status, xhr) {
                    // success callback function
                    if (data[0].status === "oke") {
                    $(".data-daftar-obat").remove();
                   
                    data.forEach((element, key) => {
                        $("#hasil-daftar-obat").append("<tr class='data-daftar-obat' id='tr_daftar-obat_" + key + "'>");
                        var cb = ` <div class='form-check'>
                        <input name="bayarObat[${key+1}]" onchange="setHarga(this)" harga="${element.data["harga"]}" value="${element.data["data_obat_id"]}" type='checkbox' class='form-check-input' ${element.data["status_bayar"] == 1 ? 'checked' : ''} ${element.data["status_bayar"] == 1 ? 'disabled' : ''}>
                        </div>`
                        $("#tr_daftar-obat_" + key).append("<th>"+ cb +" </th>");
                        $("#tr_daftar-obat_" + key).append("<th>" + (key + 1) + "</th>");
                        $("#tr_daftar-obat_" + key).append("<th>" + element.data["NamaObat"] + "</th>");
                        $("#tr_daftar-obat_" + key).append("<th>" + element.data["jumlah_pemakaian"] + "</th>");
                        $("#tr_daftar-obat_" + key).append("<th>Rp. " +formatRupiah(element.data["harga"]) + "</th>");
                        $("#hasil-daftar-obat").append("</tr>");
                    });
                    
                    $("#daftar-obat")
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
    </script>
    <!-- Get Data -->
    <script>
        // Pasien
        var pasien = $('#pasien').val();
        var bytes  = CryptoJS.AES.decrypt(pasien.toString(), 'Klinik-GIGI-APPS');
        var pasien = bytes.toString(CryptoJS.enc.Utf8);
        $('#pasien-input').val(pasien);
        // Nota
        var nota = $('#nota').val();
        var bytes  = CryptoJS.AES.decrypt(nota.toString(), 'Klinik-GIGI-APPS');
        var nota_id = bytes.toString(CryptoJS.enc.Utf8);
        $('#nota-input').val(nota_id);
        // Rekam Medis
        var rekam_medis = $('#rekam_medis').val();
        var bytes  = CryptoJS.AES.decrypt(rekam_medis.toString(), 'Klinik-GIGI-APPS');
        var rekam_medis_id = bytes.toString(CryptoJS.enc.Utf8);

        getTindakan(rekam_medis_id)
        getObat(rekam_medis_id)   
        getAlat(rekam_medis_id)   
    </script>
    <!-- Harga -->
    <script>
        function setTotalTarif(data){
            $('#total-harga').html(formatRupiah(data));
            $('#total-harga-input').val(data);
        }
        var total_tarif = $('#total_tarif').val();
        var bytes  = CryptoJS.AES.decrypt(total_tarif.toString(), 'Klinik-GIGI-APPS');
        var total_tarif  = bytes.toString(CryptoJS.enc.Utf8);
        var total_tarif = parseInt(total_tarif) + 10000
        setTotalTarif(total_tarif)
        // console.log("Total Tarif Awal : " +total_tarif)
        function setHarga(data){
            var total = 0
            var harga = $(data).attr('harga');
            if($(data).is(":checked")){
                total = parseInt(total_tarif) + parseInt(harga)
            }
            else{
                total = parseInt(total_tarif) - parseInt(harga)
            }
            total_tarif= total
            // console.log("Total tarif Ubah : " + total)
            // console.log("Total Tarif Fix :" +total_tarif)
            setTotalTarif(total)
        }
        
    </script>
    <!-- Submit -->
    <script>
        $('#btn-verif').click(function(e){
            e.preventDefault()
            Swal.fire({
                title: "Apakah anda yakin verif nota?",
                showCancelButton: true,
                confirmButtonText: "Ya",
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.querySelector("#FormPengajuanNota");
                    var form_data = new FormData(form);
                    form_data.append('id',nota_id)
                    form_data.append('rekam_medis_id',rekam_medis_id)
                    form_data.append('status','approved');
                    var url = "../../backend/keuangan/new_update_pengajuan_nota.php";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form_data,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function (data, status, xhr) {
                            if (data.status == "success") {
                                Swal.fire({
                                    title: "Success",
                                    text: "Nota Berhasil Di Verifikasi",
                                    icon: "success",
                                    showConfirmButton: true,
                                }).then(result => {
                                    if(result.isConfirmed){
                                        window.close();
                                    }
                                })
                                
                            } else {
                                Swal.fire({
                                    title: "Error",
                                    text: "Nota Gagal Di Verifkasi",
                                    icon: "error",
                                    showConfirmButton: true,
                                });

                            }

                        },
                    });
                }
            });
        })
    </script>
</body>

</html>