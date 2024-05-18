<?php

require 'config/config.php';
require_once "models/LaporanPenjualanModel.php";

// Export FILE
if (isset($_POST['export_pdf_penjualan'])) {
    $periode = isset($_POST['periode']) ? date('Y-m', strtotime($_POST['periode'])) : date('Y-m');
    exportToPDFPenjualan($periode);
}

if (isset($_POST['export_excel_penjualan'])) {
    $periode = isset($_POST['periode']) ? date('Y-m', strtotime($_POST['periode'])) : date('Y-m');
    exportToExcelPenjualan($periode);
}

function laporanPenjualan($periode = null)
{
    global $koneksi;

    // Gunakan nilai dari $_POST['periode'] jika ada input dari 'change_periode'
    $periode = isset($_POST['change_periode']) && isset($_POST['periode']) ? date('Y-m', strtotime($_POST['periode'])) : date('Y-m');

    $result = getPeriodPenjualan($koneksi, $periode);

    if ($result) {
        require_once 'views/laporanPenjualan.php';
    } else {
        echo mysqli_error($koneksi);
    }
}

function exportToPDFPenjualan($periode = null)
{
    require "./src/assets/vendor/fpdf186/fpdf.php";

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

    // Query data dari database
    $result = getPeriodPenjualan($koneksi, $periode);

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    // Header
    $pdf->Cell($pdf->GetPageWidth(), 8, 'KERUPUK ABADI ASIKIN', 0, 1, 'C');
    $pdf->Cell($pdf->GetPageWidth(), 8, 'LAPORAN PENJUALAN', 0, 1, 'C');
    $pdf->Cell($pdf->GetPageWidth(), 8, 'PERIODE ' . strtoupper($bulan_tahun), 0, 1, 'C');
    $pdf->Ln(10);

    // Tabel Header
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(15, 10, 'No.', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(30, 10, 'No. Invoice', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Nama Pelanggan', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Jenis Produk', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Kuantitas', 1, 0, 'C');
    $pdf->Cell(25, 10, 'Harga Per Kg', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Subtotal', 1, 0, 'C');
    $pdf->Cell(25, 10, 'Diskon', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Harga Total', 1, 1, 'C');

    // Data
    $pdf->SetFont('Arial', '', 10);
    if ($result->num_rows > 0) {
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $pdf->Cell(15, 10, $no, 1, 0, 'C');
            $pdf->Cell(30, 10, date("d M Y", strtotime($row['tanggal'])), 1, 0, 'C');
            $pdf->Cell(30, 10, $row['no_invoice'], 1, 0, 'C');
            $pdf->Cell(35, 10, ($row['nama_pelanggan'] ?? '-'), 1, 0, 'C');
            $pdf->Cell(35, 10, $row['jenis_produk'], 1, 0, 'C');
            $pdf->Cell(20, 10, ($row['kuantitas'] ?? 0) . ' Kg', 1, 0, 'C');
            $pdf->Cell(25, 10, 'Rp ' . number_format(($row['harga_kg'] ?? 0), 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(30, 10, 'Rp ' . number_format(($row['subtotal'] ?? 0), 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(25, 10, 'Rp ' . number_format(($row['diskon'] ?? 0), 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(30, 10, 'Rp ' . number_format(($row['harga_total'] ?? 0), 0, ',', '.'), 1, 1, 'C');
            $no++;
        }
    } else {
        $pdf->Cell(270, 8, 'Tidak ada data', 1, 1, 'C');
    }


    // Output PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="Laporan_Penjualan_' . date('M_Y') . '.pdf"');
    $pdf->Output('I');

    mysqli_close($koneksi);
    exit();
}

function exportToExcelPenjualan($periode = null)
{
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

    // Query data dari database
    $result = getPeriodPenjualan($koneksi, $periode);

    // Membuat file Excel
    $filename = 'laporan_penjualan_' . $bulan_tahun . '.xls';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Header
    $header = '
<table border="0">
    <tr style="text-align: center;">
        <td colspan="10">
            <span style="font-size: 20px; font-weight: bold;">KERUPUK ABADI ASIKIN <br></span>
            <span style="font-size: 20px; font-weight: bold;">LAPORAN PENJUALAN <br></span>
            <span style="font-size: 20px; font-weight: bold;">PERIODE ' . strtoupper($bulan_tahun) . '<br><br></span>
        </td>
    </tr>
</table>
';

    echo $header;

    // Data 
    echo '<table border="1">';
    echo '<tr>
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
          </tr>';

    // Menulis data pada file Excel
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td style="text-align: center">' . $no . '</td>
                <td>' . date("d M Y", strtotime($row['tanggal'])) . '</td>
                <td>' . $row['no_invoice'] . '</td>
                <td>' . ($row['nama_pelanggan'] ?? '-') . '</td>
                <td>' . $row['jenis_produk'] . '</td>
                <td>' . ($row['kuantitas'] ?? 0) . ' Kg</td>
                <td>Rp ' . number_format(($row['harga_kg'] ?? 0), 0, ',', '.') . '</td>
                <td>Rp ' . number_format(($row['subtotal'] ?? 0), 0, ',', '.') . '</td>
                <td>Rp ' . number_format(($row['diskon'] ?? 0), 0, ',', '.') . '</td>
                <td>Rp ' . number_format(($row['harga_total'] ?? 0), 0, ',', '.') . '</td>
              </tr>';
        $no++;
    }
    echo '</table>';

    // Selesai menulis, tutup koneksi dan hentikan script
    mysqli_close($koneksi);
    exit();
}
