<!-- Modal -->
<div class="modal fade" id="editModal<?= $row['id_pekerja']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Pekerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" class="text-left">
                <div class="modal-body">

                    <input type="number" name="id_pekerja" value="<?= $row['id_pekerja']; ?>" hidden>

                    <div class="form-group">
                        <label for="nama_pekerja<?= $row['id_pekerja']; ?>">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_pekerja<?= $row['id_pekerja']; ?>" name="nama_pekerja" value="<?= $row['nama_pekerja']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat<?= $row['id_pekerja']; ?>">Alamat</label>
                        <textarea class="form-control" id="alamat<?= $row['id_pekerja']; ?>" name="alamat" rows="3" required><?= $row['alamat']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="no_hp<?= $row['id_pekerja']; ?>">No. HP</label>
                        <input type="text" class="form-control" id="no_hp<?= $row['id_pekerja']; ?>" name="no_hp" pattern="[0-9]*" minlength="11" maxlength="13" title="Harus berupa angka" onkeypress="return hanyaAngka(event)" value="<?= $row['no_hp']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="mulai_kerja<?= $row['id_pekerja']; ?>">Mulai Kerja</label>
                        <input type="date" class="form-control" id="mulai_kerja<?= $row['id_pekerja']; ?>" name="mulai_kerja" value="<?= $row['mulai_kerja']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="berakhir_kerja<?= $row['id_pekerja']; ?>">Berakhir Kerja</label>
                        <input type="date" class="form-control" id="berakhir_kerja<?= $row['id_pekerja']; ?>" name="berakhir_kerja" value="<?= $row['berakhir_kerja']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="bagian<?= $row['id_pekerja']; ?>">Bagian</label>
                        <input type="text" class="form-control" id="bagian<?= $row['id_pekerja']; ?>" name="bagian" value="<?= $row['bagian']; ?>" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="edit_pekerja">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function hanyaAngka(evt) {
        var charCode = evt.which ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            evt.preventDefault();
        }
    }
</script>