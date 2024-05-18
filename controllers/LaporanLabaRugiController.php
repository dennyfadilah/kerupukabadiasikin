<?php

require 'config/config.php';
require_once "models/LaporanLabaRugiModel.php";

// Export FILE
if (isset($_POST['export_pdf_laba_rugi'])) {
    $periode = isset($_POST['periode']) ? date('Y-m', strtotime($_POST['periode'])) : date('Y-m');
    exportToPDFLabaRugi($periode);
}

if (isset($_POST['export_excel_laba_rugi'])) {
    $periode = isset($_POST['periode']) ? date('Y-m', strtotime($_POST['periode'])) : date('Y-m');
    exportToExcelLabaRugi($periode);
}


function laporanLabaRugi($periode = null)
{
    global $koneksi;

    // Jika ada input dari POST, gunakan nilai dari POST
    if (isset($_POST['change_periode']) && isset($_POST['periode'])) {
        $periode = $_POST['periode'];
    }

    // Ubah format tanggal jika diperlukan
    if ($periode == null) {
        $periode = date('Y-m');
    } else {
        $periode = date('Y-m', strtotime($periode));
    }

    $result = getProduk($koneksi, $periode);

    $resultBPPMTH = getBPPMTH($koneksi, $periode);

    $resultBPPMTG = getBPPMTG($koneksi, $periode);

    $resultBO = getBO($koneksi, $periode);

    $jumlahBO = getJumlahBO($koneksi, $periode);


    if ($result && $resultBPPMTH && $resultBPPMTG && $resultBO && $jumlahBO) {
        require_once 'views/laporanLabaRugi.php';
    } else {
        echo mysqli_error($koneksi);
    }
}

// Export PDF - Masih Error
function exportToPDFLabaRugi($periode = null)
{
    require "./src/assets/vendor/fpdf186/fpdf.php";
    require "koneksi.php";

    global $koneksi;

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

    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();

    // Header
    $pdf->SetFont('Arial', 'B', 14);
    $headerText = "KERUPUK ABADI ASIKIN\nLAPORAN PERSEDIAAN\nPERIODE " . strtoupper($bulan_tahun);
    $pdf->MultiCell(0, 8, $headerText, 1, 'C');

    // Body
    // Penjualan
    $result = getProduk($koneksi, $periode);
    $resultBPPMTH = getBPPMTH($koneksi, $periode);
    $resultBPPMTG = getBPPMTG($koneksi, $periode);
    $resultBO = getBO($koneksi, $periode);
    $jumlahBO = getJumlahBO($koneksi, $periode);

    // Penjualan
    $rowPenjualan = mysqli_fetch_assoc($result);

    $mth = isset($rowPenjualan['subtotal_mentah']) ? $rowPenjualan['subtotal_mentah'] : 0;
    $mtg = isset($rowPenjualan['subtotal_matang']) ? $rowPenjualan['subtotal_matang'] : 0;
    $diskon = isset($rowPenjualan['total_diskon']) ? $rowPenjualan['total_diskon'] : 0;

    $totalPenjualan = $mth + $mtg - $diskon;

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 8, 'Pendapatan Usaha', 'LR', 1, 'L');
    $pdf->Cell(85, 8, '     Penjualan Kerupuk Mentah', 'L', 0, 'L');
    $pdf->Cell(0, 8, 'Rp' . number_format($mth, 0, ',', '.'), 'R', 1, 'L');
    $pdf->Cell(85, 8, '     Penjualan Kerupuk Matang', 'L', 0, 'L');
    $pdf->Cell(0, 8, 'Rp' . number_format($mtg, 0, ',', '.'), 'R', 1, 'L');
    $pdf->Cell(85, 8, '     Potongan Penjualan', 'L', 0, 'L');
    $pdf->SetFont('Arial', 'U', 12);
    $pdf->SetTextColor(252, 2, 4);
    $pdf->Cell(0, 8, '-Rp' . number_format($diskon, 0, ',', '.'), 'R', 1, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(85, 8, 'Penjualan Bersih', 'L', 0, 'L');
    $pdf->Cell(0, 8, '-Rp' . number_format($totalPenjualan, 0, ',', '.'), 'R', 1, 'C');

    // Biaya Produksi
    $rowBPPMTH = mysqli_fetch_assoc($resultBPPMTH);
    $rowBPPMTG = mysqli_fetch_assoc($resultBPPMTG);

    $mthBP = isset($rowBPPMTH['bpp_mentah']) ? $rowBPPMTH['bpp_mentah'] : 0;
    $mtgBP = isset($rowBPPMTG['bpp_matang']) ? $rowBPPMTG['bpp_matang'] : 0;
    $totalBPP = $mthBP + $mtgBP;

    $labaKotor = $totalPenjualan - $totalBPP;

    $pdf->Cell(0, 8, 'Biaya Pokok Produksi', 'LR', 1, 'L');
    $pdf->Cell(85, 8, '     Biaya Produksi Kerupuk Mentah', 'L', 0, 'L');
    $pdf->Cell(0, 8, 'Rp' . number_format($mthBP, 0, ',', '.'), 'R', 1, 'L');
    $pdf->Cell(85, 8, '     Biaya Produksi Kerupuk Matang', 'L', 0, 'L');
    $pdf->SetFont('Arial', 'U', 12);
    $pdf->Cell(0, 8, 'Rp' . number_format($mtgBP, 0, ',', '.'), 'R', 1, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(85, 8, '        Total Biaya Pokok Produksi', 'L', 0, 'L');
    $pdf->SetFont('Arial', 'U', 12);
    $pdf->Cell(0, 8, 'Rp' . number_format($totalBPP, 0, ',', '.'), 'R', 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 8, '             Laba / (Rugi) Kotor', 'L', 0, 'L');
    $pdf->Cell(0, 8, 'Rp' . number_format($labaKotor, 0, ',', '.'), 'R', 1, 'R');

    // Biaya Operasional
    $pdf->Cell(0, 8, 'Biaya Operasional', 'LR', 1, 'L');
    $counter = 0;
    $totalRows = mysqli_num_rows($resultBO);

    while ($rowBO = mysqli_fetch_assoc($resultBO)) {
        $jmlHarga = isset($rowBO['jumlah']) ? abs($rowBO['jumlah']) : 0;
        $counter++;
        $isLastRow = $counter === $totalRows;

        if ($isLastRow) {
            $pdf->Cell(85, 10, '     ' . $rowBO['nama_akun'], 'L', 0, 'L');
            $pdf->SetFont('Arial', 'U', 12);
            $pdf->Cell(0, 10, '-Rp ' . number_format($jmlHarga, 0, ',', '.'), 'R', 1, 'L');
        } else {

            $pdf->Cell(85, 10, '     ' . $rowBO['nama_akun'], 'L', 0, 'L');
            $pdf->Cell(0, 10, '-Rp ' . number_format($jmlHarga, 0, ',', '.'), 'R', 1, 'L');
        }
    }

    $rowBO = mysqli_fetch_assoc($jumlahBO);
    $totalBO = isset($rowBO['jumlah']) ? $rowBO['jumlah'] : 0;

    $labaRugi = $labaKotor - $totalBO;

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(95, 8, '        Total Biaya Operasional', 'L', 0, 'L');
    $pdf->SetFont('Arial', 'U', 12);
    $pdf->Cell(0, 8, 'Rp' . number_format($totalBO, 0, ',', '.'), 'R', 1, 'R');

    // Total Laba / (Rugi) bersih
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 8, 'Laba / (Rugi) Bersih', 'LB', 0, 'L');
    $pdf->Cell(0, 8, 'Rp' . number_format($labaRugi, 0, ',', '.'), 'BR', 1, 'R');

    // Output PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="Laporan_Persediaan_' . date('M_Y') . '.pdf"');
    $pdf->Output('I');

    // Close connection and exit script
    mysqli_close($koneksi);
    exit();
}


// Export Excel
function exportToExcelLabaRugi($periode = null)
{
    global $koneksi;

    require "koneksi.php";

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

    $filename = 'laporan_laba_rugi_' . $bulan_tahun . '.xls';

    $result = getProduk($koneksi, $periode);
    $resultBPPMTH = getBPPMTH($koneksi, $periode);
    $resultBPPMTG = getBPPMTG($koneksi, $periode);
    $resultBO = getBO($koneksi, $periode);
    $jumlahBO = getJumlahBO($koneksi, $periode);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Style
    echo '<style>td{border: none;}</style>';

    // Header
    echo '<table border="1">';

    // Header Section
    echo '
    <tr border="1" style="text-align: center;">
        <td colspan="7">
            <span style="font-size: 20px; font-weight: bold;">KERUPUK ABADI ASIKIN <br></span>
            <span style="font-size: 20px; font-weight: bold;">LAPORAN LABA RUGI <br></span>
            <span style="font-size: 20px; font-weight: bold;">PERIODE ' . strtoupper($bulan_tahun) . '<br></span>
        </td>
    </tr>';
    echo '</table>';

    echo '<table border="1">';

    // Fetch and Display Data
    $rowPenjualan = mysqli_fetch_assoc($result);

    $mth = isset($rowPenjualan['subtotal_mentah']) ? $rowPenjualan['subtotal_mentah'] : 0;
    $mtg = isset($rowPenjualan['subtotal_matang']) ? $rowPenjualan['subtotal_matang'] : 0;
    $diskon = isset($rowPenjualan['total_diskon']) ? $rowPenjualan['total_diskon'] : 0;

    $totalPenjualan = $mth + $mtg - $diskon;

    echo '
    <tr>
        <td colspan="4">Pendapatan Usaha</td>
    </tr>
    <tr>
        <td colspan="4" style="margin-left: 20px;">Penjualan Kerupuk Mentah</td>
        <td style="text-align: center">Rp ' . number_format($mth, 0, ',', '.') . '</td>
    </tr>
    <tr>
        <td colspan="4" style="margin-left: 20px;">Penjualan Kerupuk Matang</td>
        <td style="text-align: center">Rp ' . number_format($mtg, 0, ',', '.') . '</td>
    </tr>
    <tr>
        <td colspan="4" style="margin-left: 20px;">Potongan Penjualan</td>
        <td style="border-bottom: 1px solid black; text-align: center">(Rp ' . number_format($diskon, 0, ',', '.') . ')</td>
    </tr>
    <tr>
        <td colspan="4">Penjualan Bersih</td>
        <td></td>
        <td style="text-align: center">Rp ' . number_format($totalPenjualan, 0, ',', '.') . '</td>
    </tr>';

    $rowBPPMTH = mysqli_fetch_assoc($resultBPPMTH);
    $rowBPPMTG = mysqli_fetch_assoc($resultBPPMTG);

    $mthBP = isset($rowBPPMTH['bpp_mentah']) ? $rowBPPMTH['bpp_mentah'] : 0;
    $mtgBP = isset($rowBPPMTG['bpp_matang']) ? $rowBPPMTG['bpp_matang'] : 0;
    $totalBPP = $mthBP + $mtgBP;

    $labaKotor = $totalPenjualan - $totalBPP;

    echo '
    <tr>
        <td colspan="4">Biaya Pokok Produksi</td>
    </tr>
    <tr>
        <td colspan="4" style="margin-left: 20px;">Biaya Produksi Kerupuk Mentah</td>
        <td style="text-align: center">(Rp ' . number_format($mthBP, 0, ',', '.') . ')</td>
    </tr>
    <tr>
        <td colspan="4" style="margin-left: 20px;">Biaya Produksi Kerupuk Matang</td>
        <td style="border-bottom: 1px solid black; text-align: center">(Rp ' . number_format($mtgBP, 0, ',', '.') . ')</td>
    </tr>
    <tr>
        <td colspan="4" style="margin-left: 40px;">Total Biaya Pokok Produksi</td>
        <td></td>
        <td style="border-bottom: 1px solid black; text-align: center">(Rp ' . number_format($totalBPP, 0, ',', '.') . ')</td>
    </tr>
    <tr>
        <td colspan="4" style="margin-left: 60px;">Laba / (Rugi) Kotor</td>
        <td colspan="2"></td>
        <td style="text-align: center">' . ($labaKotor < 0 ? '(Rp ' . number_format(abs($labaKotor), 0, ',', '.') . ')' : 'Rp ' . number_format($labaKotor, 0, ',', '.')) . '</td>
    </tr>';

    echo '
    <tr>
        <td colspan="4">Biaya Operasional</td>
    </tr>';

    $counter = 0;
    $totalRows = mysqli_num_rows($resultBO);

    while ($rowBO = mysqli_fetch_assoc($resultBO)) {
        $jmlHarga = isset($rowBO['jumlah']) ? abs($rowBO['jumlah']) : 0;
        $counter++;

        // Tambahkan logika kondisional untuk menentukan apakah saat ini looping terakhir
        $isLastRow = $counter === $totalRows;

        // Tambahkan border-bottom hanya pada looping terakhir
        $borderStyle = $isLastRow ? 'border-bottom: 1px solid black;' : '';

        echo '
    <tr>
        <td colspan="4" style="margin-left: 20px;">' . $rowBO['nama_akun'] . '</td>
        <td style="text-align: center; ' . $borderStyle . '">(Rp ' . number_format($jmlHarga, 0, ',', '.') . ')</td>
    </tr>';
    }

    $rowBO = mysqli_fetch_assoc($jumlahBO);
    $totalBO = isset($rowBO['jumlah']) ? $rowBO['jumlah'] : 0;

    $labaRugi = $labaKotor - $totalBO;

    echo '
    <tr>
        <td colspan="4" style="margin-left: 40px;">Total Biaya Operasional</td>
        <td colspan="2"></td>
        <td style="border-bottom: 1px solid black; text-align: center">(Rp ' . number_format($totalBO, 0, ',', '.') . ')</td>
    </tr>
    <tr>
        <td colspan="4">Laba / (Rugi) Bersih</td>
        <td colspan="2"></td>
        <td style="text-align: center">' . ($labaRugi < 0 ? '(Rp ' . number_format(abs($labaRugi), 0, ',', '.') . ')' : 'Rp ' . number_format($labaRugi, 0, ',', '.')) . '</td>
    </tr>';

    echo '</table>';

    // Selesai menulis, tutup koneksi dan hentikan script
    mysqli_close($koneksi);
    exit();
}
