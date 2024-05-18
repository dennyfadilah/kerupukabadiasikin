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

<div class="card mb-4">
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <form method="post">
                <div class="form-inline">
                    <div class="form-group">
                        <label for="periode">Periode :</label>
                        <input type="month" class="form-control ml-2" id="periode" name="periode" value="<?= $periode; ?>" min="<?= date('2010-01'); ?>" max="<?= date('Y-m'); ?>">
                    </div>

                    <button type="submit" class="btn btn-primary" id="change-periode" name="change_periode" hidden></button>
                </div>
            </form>

            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-expanded="false">
                    Simpan
                </button>
                <div class="dropdown-menu dropdown-menu-lg-right">
                    <button class="dropdown-item" type="button" id="export-pdf">PDF</button>
                    <button class="dropdown-item" type="button" id="export-excel">EXCEL</button>
                </div>
            </div>
        </div>

        <div class="text-center">
            <h5 class="m-0  font-weight-bold">KERUPUK ABADI ASIKIN</h5>
            <h5 class="m-0 font-weight-bold">LAPORAN PERSEDIAAN</h5>
            <h5 class="mb-4 font-weight-bold uppercase">PERIODE <?= strtoupper($bulan_tahun); ?>
            </h5>
        </div>

        <div id="produk_mentah" class="mb-4">
            <h6 class="mb-3 font-weight-bold">PERSEDIAAN BARANG DALAM PROSES (PRODUK MENTAH)</h6>

            <div class="table-responsive">
                <table class="table table-bordered display nowrap" id="laporan-persediaan-mth" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Tanggal</th>
                            <th rowspan="2">No. Invoice</th>
                            <th rowspan="2">Keterangan</th>
                            <th colspan="3" data-dt-order="disable">Barang Masuk</th>
                            <th colspan="3" data-dt-order="disable">Barang Keluar</th>
                            <th colspan="3" data-dt-order="disable">Saldo</th>
                        </tr>
                        <tr>
                            <th>Hasil Produksi Per Kg</th>
                            <th>Harga Per Kg</th>
                            <th>Total Biaya</th>
                            <th>Kuantitas</th>
                            <th>Harga Per Kg</th>
                            <th>Total Biaya</th>
                            <th>Kuantitas</th>
                            <th>Harga Per Kg</th>
                            <th>Total Biaya</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        $no = 1;
                        while ($row = mysqli_fetch_array($resultPMTH, MYSQLI_ASSOC)) {
                            $idNameRow = 'id_mth';
                            $id = $row[$idNameRow];
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
                                <td><?= $row['no_invoice']; ?></td>
                                <td><?= $row['keterangan']; ?></td>
                                <td><?= $row['bm_qty']; ?></td>
                                <td>Rp <?= number_format($row['bm_harga'], 0, ',', '.'); ?></td>
                                <td>Rp <?= number_format($row['bm_total'], 0, ',', '.'); ?></td>
                                <td><?= $row['bk_qty']; ?></td>
                                <td>Rp <?= number_format($row['bk_harga'], 0, ',', '.'); ?></td>
                                <td>Rp <?= number_format($row['bk_total'], 0, ',', '.'); ?></td>
                                <td><?= $row['saldo_qty']; ?></td>
                                <td>Rp <?= number_format($row['saldo_harga'], 0, ',', '.'); ?></td>
                                <td>Rp <?= number_format($row['saldo_total'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php
                            $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="produk_matang">
            <h6 class="mb-3 font-weight-bold">PERSEDIAAN BARANG JADI (PRODUK MATANG)</h6>

            <div class="table-responsive">
                <table class="table table-bordered display nowrap" id="laporan-persediaan-mtg" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Tanggal</th>
                            <th rowspan="2">No. Invoice</th>
                            <th rowspan="2">Keterangan</th>
                            <th colspan="3" data-dt-order="disable">Barang Masuk</th>
                            <th colspan="3" data-dt-order="disable">Barang Keluar</th>
                            <th colspan="3" data-dt-order="disable">Saldo</th>
                        </tr>
                        <tr>
                            <th>Hasil Produksi Per Kg</th>
                            <th>Harga Per Kg</th>
                            <th>Total Biaya</th>
                            <th>Kuantitas</th>
                            <th>Harga Per Kg</th>
                            <th>Total Biaya</th>
                            <th>Kuantitas</th>
                            <th>Harga Per Kg</th>
                            <th>Total Biaya</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        $no = 1;
                        while ($row = mysqli_fetch_array($resultPMTG, MYSQLI_ASSOC)) {
                            $idNameRow = 'id_mtg';
                            $id = $row[$idNameRow];
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
                                <td><?= $row['no_invoice']; ?></td>
                                <td><?= $row['keterangan']; ?></td>
                                <td><?= $row['bm_qty']; ?></td>
                                <td>Rp <?= number_format($row['bm_harga'], 0, ',', '.'); ?></td>
                                <td>Rp <?= number_format($row['bm_total'], 0, ',', '.'); ?></td>
                                <td><?= $row['bk_qty']; ?></td>
                                <td>Rp <?= number_format($row['bk_harga'], 0, ',', '.'); ?></td>
                                <td>Rp <?= number_format($row['bk_total'], 0, ',', '.'); ?></td>
                                <td><?= $row['saldo_qty']; ?></td>
                                <td>Rp <?= number_format($row['saldo_harga'], 0, ',', '.'); ?></td>
                                <td>Rp <?= number_format($row['saldo_total'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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
        xhr.open('POST', 'laporanPersediaan.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.responseType = 'blob';

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                let blob = new Blob([xhr.response], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'Laporan_Persediaan_' + monthName + '_' + year + ' .xls';
                link.click();
            }
        }

        // Kirim permintaan XHR dengan nilai periode yang dipilih
        xhr.send('export_excel_persediaan=true&periode=' + selectedPeriode);
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
        xhr.open('POST', 'laporanPersediaan.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.responseType = 'blob';

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                let blob = new Blob([xhr.response], {
                    type: 'application/pdf'
                });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'Laporan_Persediaan_' + monthName + '_' + year + '.pdf';
                link.click();
            }
        }

        // Kirim permintaan XHR dengan nilai periode yang dipilih
        xhr.send('export_pdf_persediaan=true&periode=' + selectedPeriode);
    });
</script>