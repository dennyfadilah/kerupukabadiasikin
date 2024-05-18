<!-- Modal -->
<div class="modal fade" id="editModal<?= $row['id_mtg']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Kerupuk Mentah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" class="text-left">
                <div class="modal-body">

                    <h5 class="text-center font-weight-bold">
                        <u><?= $row['status']; ?></u>
                    </h5>

                    <input type="hidden" name="id_mtg" value="<?= $row['id_mtg']; ?>">

                    <div class="form-group">
                        <label for="tanggal<?= $row['id_mtg']; ?>">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal<?= $row['id_mtg']; ?>" value="<?= $row['tanggal']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="no_invoice<?= $row['id_mtg']; ?>">No. Invoice</label>
                        <input type="text" class="form-control" name="no_invoice" id="no_invoice<?= $row['id_mtg']; ?>" value="<?= $row['no_invoice']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="keterangan<?= $row['id_mtg']; ?>">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan<?= $row['id_mtg']; ?>" value="<?= $row['keterangan']; ?>">
                    </div>

                    <!-- Jika barang masuk -->
                    <div class="form-group d-none" id="form_bm<?= $row['id_mtg']; ?>">

                        <input type="hidden" name="status" value="Barang Masuk">

                        <div class="form-group">
                            <label for="bm_total<?= $row['id_mtg']; ?>">Total Biaya</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" class="form-control" name="bm_total" id="bm_total<?= $row['id_mtg']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bm_qty<?= $row['id_mtg']; ?>">Hasil Produksi Per Kg</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="bm_qty<?= $row['id_mtg']; ?>" name="bm_qty" min="0">
                                <div class="input-group-append">
                                    <div class="input-group-text">Kg</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bm_harga<?= $row['id_mtg']; ?>">Harga Per Kg</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" class="form-control" name="bm_harga" id="bm_harga<?= $row['id_mtg']; ?>" min="0">
                            </div>
                        </div>
                    </div>

                    <!-- Jika barang keluar -->
                    <div class="form-group d-none" id="form_bk<?= $row['id_mtg']; ?>">

                        <input type="hidden" name="status" value="Barang Keluar">

                        <div class="form-group">
                            <label for="bk_qty<?= $row['id_mtg']; ?>">Kuantitas</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="bk_qty<?= $row['id_mtg']; ?>" name="bk_qty" min="0">
                                <div class="input-group-append">
                                    <div class="input-group-text">Kg</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bk_harga<?= $row['id_mtg']; ?>">Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" class="form-control" name="bk_harga" id="bk_harga<?= $row['id_mtg']; ?>" min="0">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bk_total<?= $row['id_mtg']; ?>">Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" class="form-control" name="bk_total" id="bk_total<?= $row['id_mtg']; ?>" disabled>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="edit_kerupuk_matang">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        /* -------------------------------------------------- */
        /*              Start - Cek Status Barang             */
        /* -------------------------------------------------- */

        const status = "<?= $row['status']; ?>";

        const formBM = document.getElementById("form_bm<?= $row['id_mtg']; ?>");
        const formBK = document.getElementById("form_bk<?= $row['id_mtg']; ?>");

        if (status === "Barang Masuk") {
            formBM.classList.remove("d-none");
            formBK.classList.add("d-none");
        } else if (status === "Barang Keluar") {
            formBK.classList.remove("d-none");
            formBM.classList.add("d-none");
        }

        /* -------------------------------------------------- */
        /*               End - Cek Status Barang              */
        /* -------------------------------------------------- */


        /* -------------------------------------------------- */
        /*               Calculate Input BM & BK              */
        /* -------------------------------------------------- */

        /* -------------- (Start) Barang Masuk -------------- */
        let inputHargaTotalBM = document.getElementById("bm_total<?= $row['id_mtg']; ?>");
        let inputKuantitasBM = document.getElementById("bm_qty<?= $row['id_mtg']; ?>");
        let inputHargaKgBM = document.getElementById("bm_harga<?= $row['id_mtg']; ?>");

        inputHargaTotalBM.value = "<?= $row['bm_total']; ?>";
        inputKuantitasBM.value = "<?= $row['bm_qty']; ?>";
        inputHargaKgBM.value = "<?= $row['bm_harga']; ?>";

        function calculateTotalPrice() {
            const total = inputHargaTotalBM.value;
            const kuantitas = inputKuantitasBM.value;
            const hargaKg = total / kuantitas;

            inputHargaKgBM.value = hargaKg;
        }

        inputHargaTotalBM.addEventListener("input", calculateTotalPrice);
        inputKuantitasBM.addEventListener("input", calculateTotalPrice);
        /* --------------- (End) Barang Masuk --------------- */


        /* -------------- (Start) Barang Keluar ------------- */
        let inputKuantitasBK = document.getElementById("bk_qty<?= $row['id_mtg']; ?>");
        let inputHargaKgBK = document.getElementById("bk_harga<?= $row['id_mtg']; ?>");
        let inputHargaTotalBK = document.getElementById("bk_total<?= $row['id_mtg']; ?>");

        inputKuantitasBK.value = "<?= $row['bk_qty']; ?>";
        inputHargaKgBK.value = "<?= $row['bk_harga']; ?>";
        inputHargaTotalBK.value = "<?= $row['bk_total']; ?>";

        function calculateTotalPriceBK() {
            const kuantitasBK = inputKuantitasBK.value;
            const hargaKgBK = inputHargaKgBK.value;

            const totalBK = kuantitasBK * hargaKgBK;
            inputHargaTotalBK.value = totalBK;
        }

        inputKuantitasBK.addEventListener("input", calculateTotalPriceBK);
        inputHargaKgBK.addEventListener("input", calculateTotalPriceBK);
        /* --------------- (End) Barang Keluar -------------- */

        /* -------------------------------------------------- */
        /*            (End) Calculate Input BM & BK           */
        /* -------------------------------------------------- */
    });
</script>