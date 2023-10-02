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
                    <?php if($_SESSION['auth']['role'] == 'admin' || $_SESSION['auth']['role'] == 'karyawan'):?>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama Pasien</label>
                        <select name="pasien" id="pasienReservasi" class="select2bs4" style="width: 100%;" required>
                            <option value="">Pilih Nama Pasien</option>
                            <option value="laki-laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <?php endif;?>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal_tambah" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Hari</label>
                        <input type="text" class="form-control" name="hari" id="hari_tambah"  required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">No Antrian (Dapat Berubah Ketika Disimpan)</label>
                        <input type="text" class="form-control" id="no_antrian"  required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jam (Dapat Berubah Ketika Disimpan)</label>
                        <input type="text" class="form-control" id="jam"  required readonly>
                    </div>
                    <input type="hidden" id="id_jadwal_dokter_hide">
                    <input type="hidden" id="jam_jadwal_dokter_hide">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close_add" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="submit_add_reservasi" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>