<!-- Modal -->
<div class="modal fade" id="editModal<?= $row['id_pj']; ?>" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" class="text-left">
                <div class="modal-body">

                    <input type="hidden" name="id_pj" value="<?= $row['id_pj']; ?>">

                    <div class="form-group">
                        <label for="tanggal<?= $row['id_pj']; ?>">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal<?= $row['id_pj']; ?>" name="tanggal"
                            value="<?= $row['tanggal']; ?>" required>
                    </div>

                    <?php
                    $string = $row['no_invoice'];

                    $part1 = substr($string, 0, 2);
                    $part2 = substr($string, 2, 2);
                    $part3 = substr($string, 5, 2);
                    $part4 = substr($string, 8);

                    ?>

                    <div class="form-group">
                        <label for="no_invoice">No. Invoice : <span class="user-select-all font-weight-bold"
                                id="view_no_invoice<?= $row['id_pj']; ?>"></span></label>
                        <div class="form-row">

                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="AA" disabled>
                            </div>

                            <div class="col-md-3">
                                <select class="custom-select" name="bulan" id="ubahBulan<?= $row['id_pj']; ?>" required>
                                    <option selected disabled>Bulan</option>
                                    <option value="01" <?= ($part2 == '01') ? 'selected' : ''; ?>>01</option>
                                    <option value="02" <?= ($part2 == '02') ? 'selected' : ''; ?>>02</option>
                                    <option value="03" <?= ($part2 == '03') ? 'selected' : ''; ?>>03</option>
                                    <option value="04" <?= ($part2 == '04') ? 'selected' : ''; ?>>04</option>
                                    <option value="05" <?= ($part2 == '05') ? 'selected' : ''; ?>>05</option>
                                    <option value="06" <?= ($part2 == '06') ? 'selected' : ''; ?>>06</option>
                                    <option value="07" <?= ($part2 == '07') ? 'selected' : ''; ?>>07</option>
                                    <option value="08" <?= ($part2 == '08') ? 'selected' : ''; ?>>08</option>
                                    <option value="09" <?= ($part2 == '09') ? 'selected' : ''; ?>>09</option>
                                    <option value="10" <?= ($part2 == '10') ? 'selected' : ''; ?>>10</option>
                                    <option value="11" <?= ($part2 == '11') ? 'selected' : ''; ?>>11</option>
                                    <option value="12" <?= ($part2 == '12') ? 'selected' : ''; ?>>12</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <input type="number" class="form-control" placeholder="Tahun" min="20" name="tahun"
                                    id="ubahTahun<?= $row['id_pj']; ?>" value="<?= $part3; ?>" required>
                            </div>

                            <div class="col-md-3">
                                <input type="number" class="form-control" placeholder="No" min="1" max="99999"
                                    maxlength="5" id="ubahAngka<?= $row['id_pj']; ?>" name="no" value="<?= $part4; ?>"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_pelanggan<?= $row['id_pj']; ?>">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama_pelanggan<?= $row['id_pj']; ?>"
                            name="nama_pelanggan" value="<?= $row['nama_pelanggan']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_produk<?= $row['id_pj']; ?>">Jenis Produk</label>
                        <div>
                            <select class="custom-select" name="jenis_produk" id="jenis_produk<?= $row['id_pj']; ?>"
                                required>
                                <option value="Kerupuk Mentah"
                                    <?= ($row['jenis_produk'] == 'Kerupuk Mentah') ? 'selected' : ''; ?>>Kerupuk Mentah
                                </option>
                                <option value="Kerupuk Matang"
                                    <?= ($row['jenis_produk'] == 'Kerupuk Matang') ? 'selected' : ''; ?>>Kerupuk Matang
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                            <label for="kuantitas<?= $row['id_pj']; ?>">Kuantitas</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="kuantitas<?= $row['id_pj']; ?>"
                                    name="kuantitas" min="0" value="<?= $row['kuantitas']; ?>" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">Kg</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="harga_kg<?= $row['id_pj']; ?>">Harga Per Kg</label>
                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>

                                <input type="number" class="form-control" id="harga_kg<?= $row['id_pj']; ?>"
                                    name="harga_kg" min="0" value="<?= $row['harga_kg']; ?>" required>

                                <div class="input-group-append">
                                    <div class="input-group-text">Kg</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="subtotal<?= $row['id_pj']; ?>">Subtotal</label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>

                                <input type="number" class="form-control" id="subtotal<?= $row['id_pj']; ?>"
                                    name="subtotal" min="0" value="<?= $row['subtotal']; ?>" readonly>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="diskon<?= $row['id_pj']; ?>">Diskon</label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>

                                <input type="number" class="form-control" id="diskon<?= $row['id_pj']; ?>" name="diskon"
                                    min="0" value="<?= $row['diskon']; ?>" required>

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="harga_total<?= $row['id_pj']; ?>">Harga Total</label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>

                            <input type="number" class="form-control" id="harga_total<?= $row['id_pj']; ?>"
                                name="harga_total" value="<?= $row['harga_total']; ?>" readonly>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="edit_penjualan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const inputKuantitas = document.getElementById("kuantitas<?= $row['id_pj']; ?>");
    const inputHargaKg = document.getElementById("harga_kg<?= $row['id_pj']; ?>");
    const inputsubTotal = document.getElementById("subtotal<?= $row['id_pj']; ?>");
    const inputDiskon = document.getElementById("diskon<?= $row['id_pj']; ?>");
    const inputHargaTotal = document.getElementById("harga_total<?= $row['id_pj']; ?>");

    const viewInvoice = document.getElementById("view_no_invoice<?= $row['id_pj']; ?>");
    const inputAngka = document.getElementById("ubahAngka<?= $row['id_pj']; ?>");
    const inputTahun = document.getElementById("ubahTahun<?= $row['id_pj']; ?>");
    const selectBulan = document.getElementById("ubahBulan<?= $row['id_pj']; ?>");

    viewInvoice.innerText = "<?= $row['no_invoice']; ?>";

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

    // Function untuk mengubah nomor invoice
    function generateInvoice() {
        let angka = inputAngka.value;
        let tahun = inputTahun.value;
        let bulan = selectBulan.value;

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

    inputAngka.addEventListener("input", generateInvoice);
    inputTahun.addEventListener("input", generateInvoice);
    selectBulan.addEventListener("change", generateInvoice);
});
</script>