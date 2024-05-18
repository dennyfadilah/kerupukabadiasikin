<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data Kerupuk Mentah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                    </div>

                    <div class="form-group">
                        <label for="no_invoice">No. Invoice</label>
                        <input type="text" class="form-control" name="no_invoice" id="no_invoice">
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan">
                    </div>

                    <div class="form-group">
                        <nav>
                            <div class="nav nav-pills nav-justified justify-content-center" id="nav-tab" role="tablist">
                                <button class="nav-link active border-0 rounded-0" id="nav-barang-masuk-tab" data-toggle="tab" data-target="#nav-barang-masuk" type="button" role="tab" aria-controls="nav-barang-masuk" aria-selected="true">Barang Masuk</button>
                                <button class="nav-link border-0 rounded-0" id="nav-barang-keluar-tab" data-toggle="tab" data-target="#nav-barang-keluar" type="button" role="tab" aria-controls="nav-barang-keluar" aria-selected="false">Barang Keluar</button>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <!-- Form Barang Masuk -->
                            <div class="tab-pane fade show active mt-3" id="nav-barang-masuk" role="tabpanel" aria-labelledby="nav-barang-masuk-tab">

                                <div class="form-group">
                                    <label for="bm_total">Total Biaya</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" name="bm_total" id="bm_total">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bm_qty">Hasil Produksi Per Kg</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="bm_qty" name="bm_qty" min="0">
                                        <div class="input-group-append">
                                            <div class="input-group-text">Kg</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bm_harga">Harga Per Kg</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" name="bm_harga" id="bm_harga" min="0">
                                    </div>
                                </div>

                            </div>
                            <!-- End Form Barang Masuk -->

                            <!-- Form Barang Keluar -->
                            <div class="tab-pane fade mt-3" id="nav-barang-keluar" role="tabpanel" aria-labelledby="nav-barang-keluar-tab">

                                <div class="form-group">

                                    <!-- PHP - Kuantitas -->
                                    <?php

                                    $resultMtg = mysqli_query($koneksi, "SELECT saldo_qty FROM kerupuk_matang ORDER BY id_mtg DESC LIMIT 1");

                                    $rowMtg = mysqli_fetch_array($resultMtg, MYSQLI_ASSOC);

                                    $mtgQty = $rowMtg['saldo_qty'];

                                    ?>

                                    <label for="bk_qty">Kuantitas</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="bk_qty" name="bk_qty" min="0" max="<?= $mtgQty; ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">Kg</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bk_harga">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" name="bk_harga" id="bk_harga" min="0">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bk_total">Total Biaya</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" name="bk_total" id="bk_total" disabled>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="add_kerupuk_matang">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        /* -------------------------------------------------- */
        /*               Calculate Input BM & BK              */
        /* -------------------------------------------------- */
        /* -------------- (Start) Barang Masuk -------------- */
        const inputHargaTotal = document.getElementById("bm_total");
        const inputKuantitas = document.getElementById("bm_qty");
        const inputHargaKg = document.getElementById("bm_harga");

        function calculateTotalPrice() {
            const kuantitas = inputKuantitas.value;
            const total = inputHargaTotal.value;
            const hargaKg = total / kuantitas;

            inputHargaKg.value = hargaKg;
        }

        inputHargaTotal.addEventListener("input", calculateTotalPrice);
        inputKuantitas.addEventListener("input", calculateTotalPrice);
        /* --------------- (End) Barang Masuk --------------- */

        /* -------------- (Start) Barang Keluar ------------- */
        const inputKuantitasBK = document.getElementById("bk_qty");
        const inputHargaKgBK = document.getElementById("bk_harga");
        const inputHargaTotalBK = document.getElementById("bk_total");

        function calculateTotalPriceBK() {
            const kuantitas = inputKuantitasBK.value;
            const hargaKg = inputHargaKgBK.value;
            const total = kuantitas * hargaKg;

            inputHargaTotalBK.value = total;
        }

        inputKuantitasBK.addEventListener("input", calculateTotalPriceBK);
        inputHargaKgBK.addEventListener("input", calculateTotalPriceBK);
        /* --------------- (End) Barang Keluar -------------- */

        /* -------------------------------------------------- */
        /*            (End) Calculate Input BM & BK           */
        /* -------------------------------------------------- */

        /* -------------------------------------------------- */
        /*                 Value BK Sesuai tab                */
        /* -------------------------------------------------- */
        let barangMasukTab = document.getElementById('nav-barang-masuk-tab');
        let barangKeluarTab = document.getElementById('nav-barang-keluar-tab');

        barangMasukTab.addEventListener('click', function() {
            document.getElementById('bk_harga').value = '';
        });

        barangKeluarTab.addEventListener('click', function() {
            document.getElementById('bk_harga').value =
                <?= isset($row['saldo_harga']) ? $row['saldo_harga'] : 0; ?>;
        });
        /* -------------------------------------------------- */
        /*              (End) Value BK Sesuai tab             */
        /* -------------------------------------------------- */
    });
</script>