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

<div class="card col-7 mb-4">
    <div class="card-body">
        <div class="d-md-flex align-items-center justify-content-between mb-4">

            <form method="post">
                <div class="form-inline">
                    <div class="form-group">
                        <label for="periode">Periode :</label>
                        <input type="month" class="form-control ml-md-2" id="periode" name="periode" value="<?= $periode; ?>" min="<?= date('2010-01'); ?>" max="<?= date('Y-m'); ?>">
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

        <div class="border border-dark p-3">
            <div class="text-center">
                <h5 class="m-0 font-weight-bold">KERUPUK ABADI ASIKIN</h5>
                <h5 class="m-0 font-weight-bold">LAPORAN LABA RUGI</h5>
                <h5 class="m-0 font-weight-bold uppercase">PERIODE <?= strtoupper($bulan_tahun); ?>
                </h5>
            </div>
        </div>

        <div class="border border-top-0 border-dark p-3">
            <!-- Pendapatan Usaha -->
            <p>Pendapatan Usaha</p>

            <div class="ml-5">
                <?php

                $rowPenjualan = mysqli_fetch_assoc($result);

                $mth = isset($rowPenjualan['subtotal_mentah']) ? $rowPenjualan['subtotal_mentah'] : 0;
                $mtg = isset($rowPenjualan['subtotal_matang']) ? $rowPenjualan['subtotal_matang'] : 0;
                $diskon = isset($rowPenjualan['total_diskon']) ? $rowPenjualan['total_diskon'] : 0;

                $totalPenjualan = $mth + $mtg - $diskon ? $mth + $mtg - $diskon : 0;

                ?>
                <div class="row">
                    <p class="col-5">Penjualan Kerupuk Mentah</p>
                    <p class="col-auto">Rp
                        <?= number_format($mth, 0, ',', '.'); ?>
                    </p>
                </div>

                <div class="row">
                    <p class="col-5">Penjualan Kerupuk Matang</p>
                    <p class="col-auto">Rp
                        <?= number_format($mtg, 0, ',', '.'); ?>
                    </p>
                </div>

                <div class="row">
                    <p class="col-5">Potongan Penjualan</p>
                    <p class="col-auto border-dark border-bottom">(Rp
                        <?= number_format($diskon, 0, ',', '.'); ?>)
                    </p>
                </div>
            </div>

            <div class="row">
                <p class="col-8">Penjualan Bersih</p>
                <p class="col-auto">Rp
                    <?= number_format($totalPenjualan, 0, ',', '.'); ?></p>
            </div>

            <!-- Biaya Produksi -->
            <p>Biaya Pokok Produksi</p>

            <div class="ml-5">
                <?php

                $rowBPPMTH = mysqli_fetch_assoc($resultBPPMTH);
                $rowBPPMTG = mysqli_fetch_assoc($resultBPPMTG);

                $mthBP = isset($rowBPPMTH['bpp_mentah']) ? $rowBPPMTH['bpp_mentah'] : 0;
                $mtgBP = isset($rowBPPMTG['bpp_matang']) ? $rowBPPMTG['bpp_matang'] : 0;

                $totalBPP = $mthBP + $mtgBP ? $mthBP + $mtgBP : 0;
                $labaKotor = $totalPenjualan - $totalBPP;

                ?>

                <div class="row">
                    <p class="col-5">Biaya Produksi Kerupuk Mentah</p>
                    <p class="col-auto">(Rp <?= number_format($mthBP, 0, ',', '.'); ?>)</p>
                </div>

                <div class="row">
                    <p class="col-5">Biaya Produksi Kerupuk Matang</p>
                    <p class="col-auto border-dark border-bottom">(Rp <?= number_format($mtgBP, 0, ',', '.'); ?>)
                    </p>
                </div>

            </div>

            <div class="row">
                <p class="col-8"><span class="ml-5 pl-3">Total Biaya Pokok Produksi</span></p>
                <p class="col-auto border-dark border-bottom">(Rp <?= number_format($totalBPP, 0, ',', '.'); ?>)</p>
            </div>

            <div class="row justify-content-between">
                <p class="col-7"><span class="ml-5 pl-5">Laba / (Rugi) Kotor</span></p>
                <p class="col-auto ml-5">
                    <?php

                    if ($labaKotor < 0) {
                        echo '(Rp ' . abs(number_format($labaKotor, 0, ',', '.')) . ')';
                    } else {
                        echo 'Rp ' . number_format($labaKotor, 0, ',', '.');
                    }

                    ?>
                </p>
            </div>

            <!-- Biaya Operasional -->
            <p>Biaya Operasional</p>

            <div class="ml-5">

                <?php

                while ($rowBO = mysqli_fetch_assoc($resultBO)) {

                    $jmlHarga = isset($rowBO['jumlah']) ? abs($rowBO['jumlah']) :  0;

                ?>
                    <div class="row">
                        <p class="col-5"><?= $rowBO['nama_akun'] ?></p>
                        <p class="col-auto">(Rp <?= number_format($jmlHarga, 0, ',', '.'); ?>)</p>
                    </div>

                <?php } ?>
            </div>

            <?php
            $rowBO = mysqli_fetch_assoc($jumlahBO);
            $totalBO = isset($rowBO['jumlah']) ? $rowBO['jumlah'] : 0;
            ?>
            <div class="row justify-content-between">
                <p class="col-7"><span class="ml-5 pl-3">Total Biaya Operasional</span></p>
                <p class="col-auto border-dark border-bottom">(Rp <?= number_format($totalBO, 0, ',', '.'); ?>)</p>
            </div>

            <!-- Laba / (Rugi) Bersih -->
            <div class="row justify-content-between font-weight-bold">
                <p class="col">Laba / (Rugi) Bersih</p>
                <p class="col-auto" id="laba-rugi">
                    <?php
                    $labaRugi = $labaKotor - $totalBO;
                    $_SESSION['laba-rugi'] = $labaRugi;

                    if ($labaRugi < 0) {
                        echo '(Rp ' . abs(number_format($labaRugi, 0, ',', '.')) . ')';
                    } else {
                        echo 'Rp ' . number_format($labaRugi, 0, ',', '.');
                    }

                    ?>
                </p>

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
        xhr.open('POST', 'laporanLabaRugi.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.responseType = 'blob';

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                let blob = new Blob([xhr.response], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'Laporan_Laba_Rugi_' + monthName + '_' + year + ' .xls';
                link.click();
            }
        }

        // Kirim permintaan XHR dengan nilai periode yang dipilih
        xhr.send('export_excel_laba_rugi=true&periode=' + selectedPeriode);
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
        xhr.open('POST', 'laporanLabaRugi.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.responseType = 'blob';

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                let blob = new Blob([xhr.response], {
                    type: 'application/pdf'
                });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'Laporan_Laba_Rugi_' + monthName + '_' + year + '.pdf';
                link.click();
            }
        }

        // Kirim permintaan XHR dengan nilai periode yang dipilih
        xhr.send('export_pdf_laba_rugi=true&periode=' + selectedPeriode);
    });
</script>