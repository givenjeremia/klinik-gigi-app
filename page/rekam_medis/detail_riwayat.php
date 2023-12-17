<div class="modal fade" id="modal-lg" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Riwayat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-informasi-tab" data-toggle="pill" href="#custom-tabs-informasi" role="tab" aria-controls="custom-tabs-informasi" aria-selected="true">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-alat-tab" data-toggle="pill" href="#custom-tabs-alat" role="tab" aria-controls="custom-tabs-alat" aria-selected="false">Alat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-tindakan-tab" data-toggle="pill" href="#custom-tabs-tindakan" role="tab" aria-controls="custom-tabs-tindakan" aria-selected="false">Tindakan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-obat-tab" data-toggle="pill" href="#custom-tabs-obat" role="tab" aria-controls="custom-tabs-obat" aria-selected="false">Obat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-lampiran-tab" data-toggle="pill" href="#custom-tabs-lampiran" role="tab" aria-controls="custom-tabs-lampiran" aria-selected="false">Lampiran</a>
                    </li>
                </ul>
                <div class="tab-content mt-2" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-informasi" role="tabpanel" aria-labelledby="custom-tabs-informasi-tab">
                        <div class="mt-2">
                            <span>Keluhan : </span>
                            <span id="informasi-keluhan">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe at optio voluptatibus minima dicta debitis ut, veritatis labore, cumque sunt numquam error ex magni ipsam natus aut exercitationem perspiciatis amet!</span>
                        </div>
                        <hr>
                        <div>
                            <span>Diagnosa : </span>
                            <span id="informasi-diagnosa">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe at optio voluptatibus minima dicta debitis ut, veritatis labore, cumque sunt numquam error ex magni ipsam natus aut exercitationem perspiciatis amet!</span>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-alat" role="tabpanel" aria-labelledby="custom-tabs-alat-tab">
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
                    <div class="tab-pane fade" id="custom-tabs-tindakan" role="tabpanel" aria-labelledby="custom-tabs-tindakan-tab">
                        <div class="table-responsive">
                            <table id="daftar-tindakan" class="table table-bordered table-striped w-100">
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
                    <div class="tab-pane fade" id="custom-tabs-obat" role="tabpanel" aria-labelledby="custom-tabs-obat-tab">
                        <div class="table-responsive">
                            <table id="daftar-Obat" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
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
                    <div class="tab-pane fade" id="custom-tabs-lampiran" role="tabpanel" aria-labelledby="custom-tabs-lampiran-tab">
                        <!-- <img src="../../assets/uploads/rekam_medis/7/2023-09-25 09.30.53.jpg" class="img-fluid" alt=""> -->

                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>

</div>