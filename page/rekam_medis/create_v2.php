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
            <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">Informasi</h3>
                </div>
                <div class="card-body">
                <div class="row mb-3">
                  <div class="col">
                    <span>Nama Dokter : <span id="informasi_nama_dokter"></span></span>
                  </div>
                  <div class="col">
                    <span>Tanggal / Waktu : <span id="informasi_tanggal_waktu"></span></span>
                  </div>
                  <div class="col">
                    <span>Spesialis : <span id="informasi_spesialis"></span> </span>
                  </div>
                </div>
                </div>
              </div>
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">Tambah Rekam Medis</h3>
                </div>
                <div class="card-body p-0">
                  <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                      <!-- your steps here -->
                      <div class="step" data-target="#diagnosa-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="diagnosa-part-trigger">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">Diagnosa</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#tindakan-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label">Tindakan</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#obat-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                          <span class="bs-stepper-circle">3</span>
                          <span class="bs-stepper-label">Obat</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#alat-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                          <span class="bs-stepper-circle">4</span>
                          <span class="bs-stepper-label">Alat</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#lampiran-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                          <span class="bs-stepper-circle">5</span>
                          <span class="bs-stepper-label">Lampiran</span>
                        </button>
                      </div>
                    </div>
                    <form id='FormCreateRekamMedis' enctype="multipart/form-data">
                      <div class="bs-stepper-content">
                        <div id="diagnosa-part" class="content" role="tabpanel" aria-labelledby="diagnosa-part-trigger">
                          <?php if (isset($_GET['reservasi']) && isset($_GET['dokter'])) : ?>
                            <input type="hidden" id="reservasi" value="<?= str_replace(' ', '+', $_GET['reservasi']) ?>">
                            <input type="hidden" id="dokter" value="<?= str_replace(' ', '+', $_GET['dokter']) ?>">
                          <?php else : ?>
                            <div class='mb-3'>
                              <label for='exampleInputPassword1' class='form-label'>Reservasi</label>
                              <select id="cboReservasi" name='reservasi' class=' select2bs4 w-100' required>
                              </select>
                              <input type="hidden" name="jadwal_dokter_id" id="dokter" id="jadwal_dokter_id">
                            </div>
                          <?php endif; ?>
                          <div class='form-group'>
                            <label for='exampleInputPassword1' class='form-label'>Keluhan</label>
                            <textarea name="keluhan" class="form-control" require></textarea>
                          </div>
                          <div class='form-group'>
                            <label for='exampleInputPassword1' class='form-label'>Diagnosa</label>
                            <textarea name="diagnosa" class="form-control" require></textarea>
                          </div>
                          <button type="button" class="btn btn-primary" onclick="stepper.next()">Selanjutnya</button>
                        </div>

                        <div id="tindakan-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                          <div class='mb-3'>
                            <div class="row mb-1">
                              <div class="col">
                                <label for='exampleInputPassword1' class='form-label'>Layanan</label>
                                <select id="cboLayanan" class='select2bs4 w-100' required>
                                </select>
                              </div>
                              <div class="col">
                                <label for='exampleInputPassword1' class='form-label'>Jumlah</label>
                                <input type="number" id="jumlah_tindakan" class="form-control">
                              </div>
                            </div>
                            <div class="row">
                              <div class=" col-6">
                                <label for='exampleInputPassword1' class='form-label'>Keterangan</label>
                                <textarea id="keterangan_tindakan" class="form-control"></textarea>
                              </div>
                              <div class="col-3">
                                <label for='exampleInputPassword1' class='form-label'>&nbsp;</label>
                                <button id="btn-tambah-tindakan" class="btn btn-primary d-block">Tambah
                                  Tindakan</button>
                              </div>
                            </div>
                          </div>
                          <div class='mb-3'>
                            <label for='exampleInputPassword1' class='form-label'>Tabel Tindakan</label>
                            <div class="table-responsive">
                              <table id="tableObat" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <!-- <th>Aksi</th> -->
                                  </tr>
                                </thead>
                                <tbody id="tableTindakanBody">

                                </tbody>
                              </table>
                            </div>
                          </div>
                          <button type="button" class="btn btn-primary" onclick="stepper.previous()">Kembali</button>
                          <button type="button" class="btn btn-primary" onclick="stepper.next()">Selanjutnya</button>
                        </div>

                        <div id="obat-part" class="content" role="tabpanel" aria-labelledby="information-part2-trigger">
                          <div class='mb-3'>
                            <div class="row mb-1">
                              <div class="col">
                                <label for='exampleInputPassword1' class='form-label'>Obat</label>
                                <select id="cboObat" class='select2bs4 w-100' required>
                                </select>
                              </div>
                              <div class="col">
                                <label for='exampleInputPassword1' class='form-label'>Keterangan</label>
                                <input type="text" id="keterangan_obat" class="form-control">
                              </div>
                            </div>
                            <div class="row">
                              <div class=" col-6">
                                <label for='exampleInputPassword1' class='form-label'>Aturan Pakai</label>
                                <input type="text" id="aturan_pakai" class="form-control">
                              </div>
                              <div class="col-3">
                                <label for='exampleInputPassword1' class='form-label'>Jumlah</label>
                                <input type="number" id="jumlah" class="form-control">
                              </div>
                              <div class="col-3">
                                <label for='exampleInputPassword1' class='form-label'>&nbsp;</label>
                                <button id="btn-tambah-obat" class="btn btn-primary d-block">Tambah Obat</button>
                              </div>
                            </div>

                          </div>
                          <div class='mb-3'>
                            <label for='exampleInputPassword1' class='form-label'>Tabel Obat</label>
                            <div class="table-responsive">
                              <table id="tableObat" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Aturan Pakai</th>
                                    <!-- <th>Aksi</th> -->
                                  </tr>
                                </thead>
                                <tbody id="tableObatBody">

                                </tbody>
                              </table>
                            </div>
                          </div>
                          <button type="button" class="btn btn-primary" onclick="stepper.previous()">Kembali</button>
                          <button type="button" class="btn btn-primary" onclick="stepper.next()">Selanjutnya</button>
                        </div>

                        <div id="alat-part" class="content" role="tabpanel" aria-labelledby="information-part2-trigger">
                          <div class='mb-3'>
                            <div class="row mb-1">
                              <div class="col">
                                <label for='exampleInputPassword1' class='form-label'>Alat</label>
                                <select id="cboAlat" class='select2bs4 w-100' required>
                                </select>
                              </div>
                              <div class="col">
                                <label for='exampleInputPassword1' class='form-label'>Pemakaian</label>
                                <input type="number" id="pemakaian" class=" form-control">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <label for='exampleInputPassword1' class='form-label'>Keterangan</label>
                                <input type="text" id="keterangan" class="form-control">
                              </div>
                              <div class="col">
                                <label for='exampleInputPassword1' class='form-label'>&nbsp;</label>
                                <button id="btn-tambah-alat" class="btn btn-primary d-block">Tambah Alat</button>
                              </div>
                            </div>
                          </div>
                          <div class='mb-3'>
                            <label for='exampleInputPassword1' class='form-label'>Tabel Alat</label>
                            <div class="table-responsive">
                              <table id="tableAlat" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th>Nama</th>
                                    <th>Pemakaian</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <!-- <th>Aksi</th> -->
                                  </tr>
                                </thead>
                                <tbody id="tableAlatBody">

                                </tbody>
                              </table>
                            </div>
                          </div>
                          <button type="button" class="btn btn-primary" onclick="stepper.previous()">Kembali</button>
                          <button type="button" class="btn btn-primary" onclick="stepper.next()">Selanjutnya</button>
                        </div>

                        <div id="lampiran-part" class="content" role="tabpanel" aria-labelledby="information-part2-trigger">
                          <div class='mb-3'>
                            <label for='exampleInputPassword1' class='form-label'>Lampiran</label>
                            <div class="custom-file">
                              <input type="file" name="lampiran" class="custom-file-input" id="exampleInputFile">
                              <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                            </div>
                          </div>
                          <div class='mb-3'>
                            <h3>Total Biaya : Rp. <span id="total-biaya-text">0</span></h3>
                            <input type="hidden" name="total_biaya" id="total_biaya_input">
                          </div>

                          <button type="button" class="btn btn-primary" onclick="stepper.previous()">Kembali</button>
                          <button type="button" id="btn-simpan-reservasi"  class="btn btn-primary">Simpan Rekam Medis</button>
                        </div>

                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-footer">
                  By Klinik Gigi 
                </div>
              </div>
            </div>
        </div>
    </div>
    <?php include '../layouts/script.php' ?>
    <?php include '../layouts/format_tanggal.php' ?>
    <?php include '../layouts/format_rupiah.php' ?>
    <script>
          document.addEventListener('DOMContentLoaded', function () {
               window.stepper = new Stepper(document.querySelector('.bs-stepper'))
          })
    </script>
    <script src='../../js/rekam_medis.js'></script>
    <script>
      function getDataDokter(){
        var id = $('#dokter').val();
        var bytes  = CryptoJS.AES.decrypt(id.toString(), 'Klinik-GIGI-APPS');
        var id = bytes.toString(CryptoJS.enc.Utf8);
        var id2 = $('#reservasi').val();
        var bytes  = CryptoJS.AES.decrypt(id2.toString(), 'Klinik-GIGI-APPS');
        var id2 = bytes.toString(CryptoJS.enc.Utf8);
        // alert(id)
        var url = "../../backend/dokter/get_data_by_id_jadwal.php";
        $.ajax(url, {
          type: "post",
          data: {
            id: id,
            id_reservasi:id2
          },
          dataType: "json",
          timeout: 500,
          success: function (data, status, xhr) {
            if (data[0].status == "success") {
              $("#informasi_nama_dokter").html(data[0].data.nama);
              $("#informasi_tanggal_waktu").html(convertDate(data[0].data.Tanggal) +'/'+data[0].data.Jam);
              $("#informasi_spesialis").html(data[0].data.spesialis_nama);

            }
          },
        });
      }
getDataDokter()
    </script>
</body>

</html>