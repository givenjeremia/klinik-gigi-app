<div class="modal fade" id="exampleModalTambahJadwal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormTambahJadwalDokter">
                    <input type="hidden" name="data_dokter" id="data_dokter">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jam</label>
                        <input type="time" class="form-control" name="jam" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Hari</label>
                        <input type="text" class="form-control" name="hari" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Kuota Pasien</label>
                        <input type="number" class="form-control" name="kuota_pasien" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close_add_jadwal" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="submit_add_jadwal" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>