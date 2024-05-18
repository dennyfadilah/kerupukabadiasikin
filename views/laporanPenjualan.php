<?php
$bulan = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
];

$bulan_tahun = $bulan[date('m', strtotime($periode))] . ' ' . date('Y', strtotime($periode));
?>

<div class="card">
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <form method="post">
                <div class="form-inline">
                    <div class="form-group">
                        <label for="periode">Periode :</label>
                        <input type="month" class="form-control ml-2" id="periode" name="periode"
                            value="<?= $periode; ?>" min="<?= date('2010-01'); ?>" max="<?= date('Y-m'); ?>">
                    </div>

                    <button type="submit" class="btn btn-primary" id="change-periode" name="change_periode"
                        hidden></button>
                </div>
            </form>

            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                    data-display="static" aria-expanded="false">
                    Simpan
                </button>
                <div class="dropdown-menu dropdown-menu-lg-right">
                    <button class="dropdown-item" type="button" id="export-pdf">PDF</button>
                    <button class="dropdown-item" type="button" id="export-excel">Excel</button>

                </div>
            </div>
        </div>

        <div class="text-center">
            <h5 class="m-0  font-weight-bold">KERUPUK ABADI ASIKIN</h5>
            <h5 class="m-0 font-weight-bold">LAPORAN PENJUALAN</h5>
            <h5 class="mb-4 font-weight-bold uppercase">PERIODE <?= strtoupper($bulan_tahun); ?>
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered display nowrap" id="laporan-penjualan" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>No. Invoice</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Produk</th>
                        <th>Kuantitas</th>
                        <th>Harga Per Kg</th>
                        <th>Subtotal</th>
                        <th>Diskon</th>
                        <th>Harga Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    $no = 1;

                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $idNameRow = 'id_pj';
                        $id = $row[$idNameRow];
                    ?>
                    <tr class="text-center">

                        <td><?= $no; ?></td>
                        <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
                        <td><?= $row['no_invoice']; ?></td>
                        <td><?= $row['nama_pelanggan'] === null ? '-' : $row['nama_pelanggan']; ?></td>
                        <td><?= $row['jenis_produk']; ?></td>
                        <td><?= $row['kuantitas'] === null ? 0 : $row['kuantitas']; ?> Kg</td>
                        <td>Rp <?= $row['harga_kg'] === null ? 0 : number_format($row['harga_kg'], 0, ',', '.'); ?>
                        </td>
                        <td>Rp <?= $row['subtotal'] === null ? 0 : number_format($row['subtotal'], 0, ',', '.'); ?>
                        </td>
                        <td>Rp <?= $row['diskon'] === null ? 0 : number_format($row['diskon'], 0, ',', '.'); ?></td>
                        <td>Rp
                            <?= $row['harga_total'] === null ? 0 : number_format($row['harga_total'], 0, ',', '.'); ?>
                        </td>

                    </tr>
                    <?php $no++;
                    } ?>

                </tbody>
                <tfoot>
                    <?php

                    $result = mysqli_query($koneksi, 'SELECT SUM(subtotal) as subtotal, SUM(diskon) as diskon, SUM(harga_total) as htotal FROM penjualan WHERE MONTH(tanggal) = ' . date('m', strtotime($periode)) . ' AND YEAR(tanggal) = ' . date('Y', strtotime($periode)));

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    ?>
                    <tr class="text-center">
                        <th class="text-right" colspan="7" data-dt-order="disable">Total</th>
                        <th data-dt-order="disable">Rp
                            <?= $row['subtotal'] === null ? 0 : number_format($row['subtotal'], 0, ',', '.'); ?>
                        </th>
                        <th data-dt-order="disable">Rp
                            <?= $row['diskon'] === null ? 0 : number_format($row['diskon'], 0, ',', '.'); ?></th>
                        <th data-dt-order="disable">Rp
                            <?= $row['htotal'] === null ? 0 : number_format($row['htotal'], 0, ',', '.'); ?>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>

<script>
const periode = document.getElementById('periode');
const changePeriode = document.getElementById('change-periode');

periode.addEventListener('change', function() {
    changePeriode.click();
})

// Export Excel
document.getElementById('export-excel').addEventListener('click', function() {
    let selectedPeriode = periode.value;

    let formattedDate = new Date(selectedPeriode +
        '-01');
    let monthName = formattedDate.toLocaleString('id-ID', {
        month: 'long'
    });
    let year = formattedDate.getFullYear();

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'laporanPenjualan.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.responseType = 'blob';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let blob = new Blob([xhr.response], {
                type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            });
            let link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'Laporan_Penjualan_' + monthName + '_' + year + ' .xls';
            link.click();
        }
    }

    // Kirim permintaan XHR dengan nilai periode yang dipilih
    xhr.send('export_excel_penjualan=true&periode=' + selectedPeriode);
});

// Export PDF
document.getElementById('export-pdf').addEventListener('click', function() {
    let selectedPeriode = periode.value;

    let formattedDate = new Date(selectedPeriode +
        '-01');
    let monthName = formattedDate.toLocaleString('id-ID', {
        month: 'long'
    });
    let year = formattedDate.getFullYear();

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'laporanPenjualan.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.responseType = 'blob';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let blob = new Blob([xhr.response], {
                type: 'application/pdf'
            });
            let link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'Laporan_Penjualan_' + monthName + '_' + year + '.pdf';
            link.click();
        }
    }

    // Kirim permintaan XHR dengan nilai periode yang dipilih
    xhr.send('export_pdf_penjualan=true&periode=' + selectedPeriode);
});
</script>