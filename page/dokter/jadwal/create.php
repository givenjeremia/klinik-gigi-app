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
                        <select name="hari" class="select2bs4 w-100" required>
                            <option value="">Pilih Hari</option>
                            <option value="Monday">Senin</option>
                            <option value="Tuesday">Selasa</option>
                            <option value="Wednesday">Rabu</option>
                            <option value="Thursday">Kamis</option>
                            <option value="Friday">Jum'at</option>
                            <option value="Saturday">Sabtu</option>
                            <option value="Sunday">Minggu</option>
                        </select>
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