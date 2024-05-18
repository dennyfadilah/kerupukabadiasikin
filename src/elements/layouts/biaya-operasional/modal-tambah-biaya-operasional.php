<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Biaya Operasional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="tanggal_bo">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal_bo" name="tanggal_bo" required>
                    </div>
                    <!-- Select Akun -->
                    <div class="form-group">
                        <label for="akun">Nama Akun</label>
                        <select class="custom-select" id="akun" name="nama_akun" onchange="toggleNewAkun()" required>
                            <option selected disabled>Pilih Akun</option>
                            <?php
                            $sql = getNamaAkun();

                            foreach ($sql as $row) {
                                echo "<option value='$row[nama_akun]'>$row[nama_akun]</option>";
                            }

                            ?>
                            <option value="newAkun">Buat Akun Baru</option>
                        </select>
                    </div>
                    <!-- End Select Akun -->

                    <!-- Input Akun Baru -->
                    <div class="form-group" id="inputField" style="display:none;">
                        <label for="inputAkun">Buat Akun Baru:</label>
                        <input type="text" class="form-control" id="inputAkun">
                    </div>
                    <!-- End Input Akun Baru -->

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="0" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="add_biaya_operasional">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const toggleNewAkun = () => {
        const selectBox = document.querySelector("#akun");
        const inputField = document.querySelector("#inputField");
        const inputAkun = document.querySelector("#inputAkun");

        if (selectBox.value === "newAkun") {
            selectBox.removeAttribute("name");
            inputField.style.display = "block";
            inputAkun.setAttribute("name", "nama_akun");
            inputAkun.setAttribute("required", true);
        } else {
            selectBox.setAttribute("name", "nama_akun");
            inputField.style.display = "none";
            if (inputAkun.hasAttribute("required") && inputAkun.hasAttribute("name")) {
                inputAkun.removeAttribute("name");
                inputAkun.removeAttribute("required");
            }
        }
    }
</script>