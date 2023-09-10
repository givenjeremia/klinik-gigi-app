<div class="modal fade" id="exampleModalTambah" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Catatan Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormTambahCatatanKeuangan">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" name="dengan_nota" type="checkbox" value="1" id="dengan_nota">
                            <label class="form-check-label" for="dengan_nota">Dengan Nota</label>
                        </div>
                    </div>
                    <div class="mb-3 d-none" id="daftar-nota-cbo">
                        <label for="exampleInputPassword1" class="form-label">Daftar Nota</label>
                        <select name="daftar_nota" id="daftar_nota_select" class="form-control" require>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jumlah</label>
                        <input type="text" class="form-control format-rupiah" id="jumlah" name="jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jenis Transaksi</label>
                        <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" require>
                            <option value="">Pilih Transaksi</option>
                            <option value="debit">Debit</option>
                            <option value="kredit">Kredit</option>
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