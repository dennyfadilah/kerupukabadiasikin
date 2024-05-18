<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data Pekerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_pekerja">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_pekerja" name="nama_pekerja" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" pattern="[0-9]*" minlength="11" maxlength="13" title="Harus berupa angka" onkeypress="return hanyaAngka(event)" required>
                    </div>
                    <div class="form-group">
                        <label for="mulai_kerja">Mulai Kerja</label>
                        <input type="date" class="form-control" id="mulai_kerja" name="mulai_kerja" required>
                    </div>
                    <div class="form-group">
                        <label for="berakhir_kerja">Berakhir Kerja</label>
                        <input type="date" class="form-control" id="berakhir_kerja" name="berakhir_kerja" required>
                    </div>
                    <div class="form-group">
                        <label for="bagian">Bagian</label>
                        <input type="text" class="form-control" id="bagian" name="bagian" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="add_pekerja">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function hanyaAngka(evt) {
        var charCode = evt.which ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            evt.preventDefault();
            return false;
        }
        return true;
    }
</script>