<!-- Modal Edit -->
<div class="modal fade" id="editModal<?= $row['id_akun']; ?>" tabindex="-1"
    aria-labelledby="editModalLabel<?= $row['id_akun']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel<?= $row['id_akun']; ?>">Edit Bahan Baku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" class="text-left">
                <div class="modal-body">

                    <input type="number" name="id_akun" value="<?= $row['id_akun']; ?>" hidden>

                    <div class="form-group">
                        <label for="nama_akun<?= $row['id_akun']; ?>">Nama Akun</label>
                        <input type="text" class="form-control" id="nama_akun<?= $row['id_akun']; ?>" name="nama_akun"
                            value="<?= $row['nama_akun']; ?>" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="edit_akun">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>