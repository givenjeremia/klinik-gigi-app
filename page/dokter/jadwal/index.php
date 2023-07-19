<div class="modal fade" id="exampleModalJadwal"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jadwal Dokter <span id="nama_dokter"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalTambahJadwal">
                    Add Jadwal
                </button>
                <input type="hidden" id="data-dokter">
                <div class="card mt-2">
                    <div class="card-header">
                        <h3 class="card-title">Data Master Jadwal</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableJadwalDokter" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jam</th>
                                        <th>Hari</th>
                                        <th>Kuota Pasien</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="hasil_jadwal">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jam</th>
                                        <th>Hari</th>
                                        <th>Kuota Pasien</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>

</div>