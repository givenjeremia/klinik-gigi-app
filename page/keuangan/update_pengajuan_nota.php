<div class="modal fade" id="exampleModalVerifNota" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Nota <span id="nota_id"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormVerifNota">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Rekam Medis</label>
                        <input type="text" class="form-control" id="rekamMedisVerif" name="rekam_medis" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="namaPasienVerif" name="nama_pasien" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggalVerif" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Total Tarif (Belum Termasuk Biaya Admin Rp. 10,000)</label>
                        <input type="text" class="form-control format-rupiah" id="totalPembayaranVerif" name="total_pembayaran" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jenis Pembayaran</label>
                        <select name="jenis_pembayaran" id="jenisPembayaranVerif" class="form-control">
                            <option value="lunas">Lunas</option>
                            <option value="cicilan">Cicilan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1"  class="form-label">Total: Rp. <span id="totalTarifLabel"></span></label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close_edit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" id="submit_edit" key="" class="btn btn-primary">Verif</button>
            </div>
        </div>
    </div>
</div>