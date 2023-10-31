<div class="modal fade" id="exampleModalTambah" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Odontogram</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormTambahOdontogram">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Rekam Medis</label>
                        <select id="cboRekamMedis" name="rekam_medis" class="select2bs4 w-100" required>
                            <option value="">Pilih Rekam Medis</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nomor Gigi</label>
                        <input type="text" class="form-control" name="nomor_gigi" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Posisi</label>
                        <input type="text" class="form-control" name="posisi" required>
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