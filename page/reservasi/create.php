<div class="modal fade" id="exampleModalJadwalReservasi"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Reservasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormCreateReservasi">
                    <input type="hidden" name="jadwal" id="jadwal_tambah">
                    <!-- IF ROLE ADMIN / KARYAWAN WITH NAMA PASIEN -->
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal_tambah" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Hari</label>
                        <input type="text" class="form-control" name="hari" id="hari_tambah"  required readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close_add" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="submit_add_reservasi" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>