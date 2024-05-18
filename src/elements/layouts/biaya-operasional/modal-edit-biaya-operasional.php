<div class="modal fade editModal" id="editModal<?= $row['id_bo']; ?>" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Biaya Operasional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" class="text-left">
                <div class="modal-body">

                    <input type="hidden" name="id_bo" value="<?= $row['id_bo']; ?>">
                    <div class="form-group">
                        <label for="tanggal_bo">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal_bo" name="tanggal_bo"
                            value="<?= $row['tanggal_bo']; ?>" required>
                    </div>

                    <!-- Select Akun -->
                    <div class="form-group">
                        <label for="editAkun">Nama Akun</label>
                        <select class="custom-select" id="editAkun<?= $row['id_bo']; ?>" name="nama_akun"
                            onchange="changeSelector(<?= $row['id_bo']; ?>)" required>
                            <option disabled>Pilih Akun</option>
                            <?php

                            $data_akun = array();
                            $sql = getNamaAkun();

                            foreach ($sql as $row_akun) {
                                $data_akun[] = $row_akun['nama_akun'];
                            }

                            foreach ($data_akun as $akun) {
                                $selected = $akun == $row['nama_akun'] ? 'selected' : '';
                                echo "<option value='$akun' $selected>$akun</option>";
                            }

                            $check = in_array($row['nama_akun'], $data_akun);
                            if (!$check) {
                                echo "<option value='customAkun' selected>Custom Akun</option>";
                            } else {
                                echo '<option value="newAkun">Buat Akun Baru</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <!-- End Select Akun -->

                    <!-- Buat Akun Baru -->
                    <div class="form-group" id="inputNewField<?= $row['id_bo']; ?>" style="display:none;">
                        <label for="inputNewAkun">Buat Akun Baru:</label>
                        <input type="text" class="form-control" id="inputNewAkun<?= $row['id_bo']; ?>">
                    </div>
                    <!-- End Buat Akun Baru -->

                    <!-- Custom Akun -->
                    <div class="form-group" id="customField<?= $row['id_bo']; ?>"
                        style="<?= !$check ? 'display:block' : 'display:none'; ?>">
                        <label for="customAkun">Custom Akun:</label>
                        <input type="text" class="form-control" id="customAkun<?= $row['id_bo']; ?>" name="nama_akun"
                            value="<?= $row['nama_akun']; ?>">
                    </div>
                    <!-- End Custom Akun -->

                    <div class="form-group">
                        <label for="keterangan<?= $row['id_bo']; ?>">Keterangan</label>
                        <textarea class="form-control" id="keterangan<?= $row['id_bo']; ?>" name="keterangan" rows="3"
                            required><?= $row['keterangan']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="jumlah<?= $row['id_bo']; ?>">Jumlah</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="number" class="form-control" id="jumlah<?= $row['id_bo']; ?>" name="jumlah"
                                min="0" value="<?= $row['jumlah']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="edit_biaya_operasional">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
function changeSelector(id_bo) {
    const selectBox = document.querySelector("#editAkun" + id_bo);
    const inputField = document.querySelector("#inputNewField" + id_bo);
    const inputAkun = document.querySelector("#inputNewAkun" + id_bo);

    const customField = document.querySelector("#customField" + id_bo);
    const customAkun = document.querySelector("#customAkun" + id_bo);
    console.log("Selector berubah: " + selectBox.value);


    if (selectBox.value === "newAkun") {
        selectBox.removeAttribute("name");
        inputField.style.display = "block";

        inputAkun.setAttribute("name", "nama_akun");
        inputAkun.setAttribute("required", true);

        if (customAkun.hasAttribute("name")) {
            customAkun.removeAttribute("name");
            if (customAkun.hasAttribute("required")) {
                customAkun.removeAttribute("required");
            }
        }

    } else if (selectBox.value === "customAkun") {
        customField.style.display = "block";

        customAkun.addEventListener("input", function() {
            selectBox.removeAttribute("name");
            customAkun.setAttribute("name", "nama_akun");
            customAkun.setAttribute("required", true);

            if (inputAkun.hasAttribute("name")) {
                inputAkun.removeAttribute("name");
                if (inputAkun.hasAttribute("required")) {
                    inputAkun.removeAttribute("required");
                }
            }
        });

    } else {
        selectBox.setAttribute("name", "nama_akun");
        inputField.style.display = "none";

        if (inputAkun.hasAttribute("name")) {
            inputAkun.removeAttribute("name");
            if (inputAkun.hasAttribute("required")) {
                inputAkun.removeAttribute("required");
            }
        }

        customField.style.display = "none";
        if (customAkun.hasAttribute("name")) {
            customAkun.removeAttribute("name");
            if (customAkun.hasAttribute("required")) {
                customAkun.removeAttribute("required");
            }
        }
    }
}
</script>