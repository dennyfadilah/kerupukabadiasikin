<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" min="2010-01-01" required>
                    </div>

                    <div class="form-group">

                        <label for="no_invoice">No. Invoice : <span class="user-select-all font-weight-bold"
                                id="view_no_invoice"></span></label>
                        <div class="form-row">

                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="AA" disabled>
                            </div>

                            <div class="col-md-3">
                                <select class="custom-select" name="bulan" id="bulan" required>
                                    <option selected disabled>Bulan</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <input type="number" class="form-control" placeholder="Tahun" min="20" name="tahun"
                                    id="tahun" required>
                            </div>

                            <div class="col-md-3">
                                <input type="number" class="form-control" placeholder="No" min="1" max="99999"
                                    maxlength="5" id="angka" name="no" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                    </div>

                    <!-- PHP - Kuantitas -->
                    <?php

                    $resultMth = mysqli_query($koneksi, "SELECT saldo_qty FROM kerupuk_mentah ORDER BY id_mth DESC LIMIT 1");
                    $resultMtg = mysqli_query($koneksi, "SELECT saldo_qty FROM kerupuk_matang ORDER BY id_mtg DESC LIMIT 1");

                    $rowMth = mysqli_fetch_array($resultMth, MYSQLI_ASSOC);
                    $rowMtg = mysqli_fetch_array($resultMtg, MYSQLI_ASSOC);

                    $mthQty = isset($rowMth['saldo_qty']) ? $rowMth['saldo_qty'] : 0;
                    $mtgQty = isset($rowMtg['saldo_qty']) ? $rowMtg['saldo_qty'] : 0;

                    $maxQty = max($mthQty, $mtgQty);

                    ?>

                    <div class="form-group">
                        <label for="jenis_produk">Jenis Produk</label>
                        <select class="custom-select" id="jenis_produk" name="jenis_produk" required>
                            <option selected disabled>Pilih Produk</option>
                            <option value="Kerupuk Mentah" data-max="<?= $mthQty ?>">Kerupuk Mentah</option>
                            <option value="Kerupuk Matang" data-max="<?= $mtgQty ?>">Kerupuk Matang</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="kuantitas">Kuantitas</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="kuantitas" name="kuantitas" min="0"
                                    required>
                                <div class="input-group-append">
                                    <div class="input-group-text">Kg</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="harga_kg">Harga Per Kg</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" class="form-control" id="harga_kg" name="harga_kg" min="0"
                                    required>
                                <div class="input-group-append">
                                    <div class="input-group-text">Kg</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="subtotal">Subtotal</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" class="form-control" id="subtotal" min="0" readonly>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="diskon">Diskon</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" class="form-control" id="diskon" name="diskon" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="harga_total">Harga Total</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="number" class="form-control" id="harga_total" readonly>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="add_penjualan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Fungsi kalkulasi realtime
document.addEventListener("DOMContentLoaded", function() {
    const inputKuantitas = document.getElementById("kuantitas");
    const inputHargaKg = document.getElementById("harga_kg");
    const inputsubTotal = document.getElementById("subtotal");
    const inputDiskon = document.getElementById("diskon");
    const inputHargaTotal = document.getElementById("harga_total");

    const viewInvoice = document.getElementById("view_no_invoice");
    const inputBulan = document.getElementById("bulan");
    const inputTahun = document.getElementById("tahun");
    const inputAngka = document.getElementById("angka");

    const jenisProduk = document.getElementById('jenis_produk');

    // Fungsi untuk Max Input Kuantitas
    // Menangani perubahan pada select jenis_produk
    jenisProduk.addEventListener('change', function() {
        // Mendapatkan nilai maksimum dari data-max atribut option yang dipilih
        let maxQty = this.options[this.selectedIndex].getAttribute('data-max');
        // Mengatur nilai maksimum pada input kuantitas
        inputKuantitas.max = maxQty;
    });


    // Function untuk kalkukasi harga total
    function calculateTotalPrice() {
        const kuantitas = inputKuantitas.value;
        const hargaKg = inputHargaKg.value;
        const diskon = inputDiskon.value;

        // kalkulasi harga total
        const subtotal = kuantitas * hargaKg;
        const total = subtotal - diskon;
        // Set nilai harga total
        inputsubTotal.value = subtotal;
        inputHargaTotal.value = total;
    }

    // Fungsi tampilan invoice
    function generateInvoice() {
        let bulan = inputBulan.value;
        let tahun = inputTahun.value;
        let angka = inputAngka.value;

        // Cek panjang angka
        if (angka.length < 5) {
            // Tambahkan 0 di depan sampai panjangnya 5
            angka = "0".repeat(5 - angka.length) + angka;
        }
        if (angka.length > 5) {
            angka.value = angka.value.substring(0, 5);
        }

        // Perbarui nilai input
        inputAngka.value = angka;

        // Menampilkan invoice
        viewInvoice.innerText = "AA" + bulan + "-" + tahun + "/" + angka;
    }

    // Event listeners dari kolom input
    inputKuantitas.addEventListener("input", calculateTotalPrice);
    inputHargaKg.addEventListener("input", calculateTotalPrice);
    inputDiskon.addEventListener("input", calculateTotalPrice);

    inputBulan.addEventListener("input", generateInvoice);
    inputTahun.addEventListener("input", generateInvoice);
    inputAngka.addEventListener("input", generateInvoice);
});
</script>