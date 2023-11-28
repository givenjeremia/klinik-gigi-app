<div class="modal fade" id="exampleModalTambah" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormTambahLayanan">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jenis</label>
                        <input type="text" class="form-control" name="jenis" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Harga</label>
                        <input type="text" class="form-control format-rupiah" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Hari</label>
                        <select name="hari_dokter" class="select2bs4 w-100" required>
                            <option value="">Pilih Hari</option>
                            <option value="Monday">Senin</option>
                            <option value="Tuesday">Selasa</option>
                            <option value="Wednesday">Rabu</option>
                            <option value="Thursday">Kamis</option>
                            <option value="Tuesday">Jum'at</option>
                            <option value="Friday">Sabtu</option>
                            <option value="Sunday">Minggu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Spesialis</label>
                        <select id="cboSpesialis" name="spesialis" class="select2bs4 w-100" required>
                        </select>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close_add" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="submit_add" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>