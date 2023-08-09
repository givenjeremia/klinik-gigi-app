<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormEditKaryawan">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama</label>
                        <input type="text" id="namaEdit" class="form-control" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamatEdit" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Telp</label>
                        <input type="number" id="telpEdit" class="form-control" name="no_telp">
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