<div class="modal fade" id="exampleModalEdit" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="FormEditPasien">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="namaEdit" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Usia</label>
                        <input type="number" class="form-control" id="usiaEdit" name="usia" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tempat Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tempatTanggalLahirEdit" name="tempat_tanggal_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamatEdit" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">No. Telepon</label>
                        <input type="number" class="form-control" id="telpEdit" name="no_telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal Daftar</label>
                        <input type="date" class="form-control" id="tanggalDaftarEdit" name="tanggal_daftar" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenisKelaminEdit" class="select2bs4" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close_edit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" id="submit_edit" key="" class="btn btn-primary">Ubah</button>
            </div>
        </div>
    </div>
</div>