<?php

require 'config/config.php';
require_once "models/LaporanPersediaanModel.php";

// Export FILE
if (isset($_POST['export_pdf_persediaan'])) {
    $periode = isset($_POST['periode']) ? date('Y-m', strtotime($_POST['periode'])) : date('Y-m');
    exportToPDFPersediaan($periode);
}

if (isset($_POST['export_excel_persediaan'])) {
    $periode = isset($_POST['periode']) ? date('Y-m', strtotime($_POST['periode'])) : date('Y-m');
    exportToExcelPersediaan($periode);
}

function laporanPersediaan($periode = null)
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

    $resultPMTH = getPMTH($periode);
    $resultPMTG = getPMTG($periode);

    if ($resultPMTH && $resultPMTG) {
        require_once 'views/laporanPersediaan.php';
    } else {
        echo mysqli_error($koneksi);
    }
}

// Export PDF
function exportToPDFPersediaan($periode = null)
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

    $resultPMTH = getPMTH($periode);
    $resultPMTG = getPMTG($periode);

    $pdf = new FPDF('L', 'mm', 'legal');
    $pdf->AddPage();

    // Header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell($pdf->GetPageWidth(), 8, 'KERUPUK ABADI ASIKIN', 0, 1, 'C');
    $pdf->Cell($pdf->GetPageWidth(), 8, 'LAPORAN PERSEDIAAN', 0, 1, 'C');
    $pdf->Cell($pdf->GetPageWidth(), 8, 'PERIODE ' . strtoupper($bulan_tahun), 0, 1, 'C');
    $pdf->Ln(3);

    // Tabel Produk Mentah Header
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 10, 'PERSEDIAAN BARANG DALAM PROSES (PRODUK MENTAH) PER KG', 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 8);
    // Header baris pertama
    $pdf->Cell(8, 10, 'No.', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(30, 10, 'No. Invoice', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Keterangan', 1, 0, 'C');
    $pdf->Cell(75, 5, 'Barang Masuk', 1, 0, 'C');
    $pdf->Cell(75, 5, 'Barang Keluar', 1, 0, 'C');
    $pdf->Cell(75, 5, 'Saldo', 1, 1, 'C');

    // Header baris kedua
    $pdf->SetX(113);
    $pdf->Cell(20, 5, 'Kuantitas', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Harga Per Kg', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Total Biaya', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Kuantitas', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Harga Per Kg', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Total Biaya', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Kuantitas', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Harga Per Kg', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Total Biaya', 1, 1, 'C');

    // Data Produk Mentah
    $pdf->SetFont('Arial', '', 8);
    if ($resultPMTH->num_rows > 0) {
        $no = 1;
        while ($row = mysqli_fetch_assoc($resultPMTH)) {
            $pdf->Cell(8, 5, $no, 1, 0, 'C');
            $pdf->Cell(30, 5, date("d M Y", strtotime($row['tanggal'])), 1, 0, 'C');
            $pdf->Cell(30, 5, $row['no_invoice'], 1, 0, 'C');
            $pdf->Cell(35, 5, $row['keterangan'], 1, 0, 'C');
            $pdf->Cell(20, 5, $row['bm_qty'], 1, 0, 'C');
            $pdf->Cell(25, 5, 'Rp ' . number_format($row['bm_harga'], 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(30, 5, 'Rp ' . number_format($row['bm_total'], 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(20, 5, $row['bk_qty'], 1, 0, 'C');
            $pdf->Cell(25, 5, 'Rp ' . number_format($row['bk_harga'], 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(30, 5, 'Rp ' . number_format($row['bk_total'], 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(20, 5, $row['saldo_qty'], 1, 0, 'C');
            $pdf->Cell(25, 5, 'Rp ' . number_format($row['saldo_harga'], 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(30, 5, 'Rp ' . number_format($row['saldo_total'], 0, ',', '.'), 1, 1, 'C');
            $no++;
        }
    } else {
        $pdf->Cell(328, 8, 'Tidak ada data', 1, 1, 'C');
    }


    $pdf->Ln(4);

    // Tabel Produk Matang Header
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 10, 'PERSEDIAAN BARANG JADI (PRODUK MATANG) PER KG', 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 8);
    // Header baris pertama
    $pdf->Cell(8, 10, 'No.', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(30, 10, 'No. Invoice', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Keterangan', 1, 0, 'C');
    $pdf->Cell(75, 5, 'Barang Masuk', 1, 0, 'C');
    $pdf->Cell(75, 5, 'Barang Keluar', 1, 0, 'C');
    $pdf->Cell(75, 5, 'Saldo', 1, 1, 'C');

    // Header baris kedua
    $pdf->SetX(113);
    $pdf->Cell(20, 5, 'Kuantitas', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Harga Per Kg', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Total Biaya', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Kuantitas', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Harga Per Kg', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Total Biaya', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Kuantitas', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Harga Per Kg', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Total Biaya', 1, 1, 'C');

    // Data Produk Matang
    $pdf->SetFont('Arial', '', 8);
    if ($resultPMTH->num_rows > 0) {
        $no = 1;
        while ($row = mysqli_fetch_assoc($resultPMTG)) {
            $pdf->Cell(8, 5, $no, 1, 0, 'C');
            $pdf->Cell(30, 5, date("d M Y", strtotime($row['tanggal'])), 1, 0, 'C');
            $pdf->Cell(30, 5, $row['no_invoice'], 1, 0, 'C');
            $pdf->Cell(35, 5, $row['keterangan'], 1, 0, 'C');
            $pdf->Cell(20, 5, $row['bm_qty'], 1, 0, 'C');
            $pdf->Cell(25, 5, 'Rp ' . number_format($row['bm_harga'], 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(30, 5, 'Rp ' . number_format($row['bm_total'], 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(20, 5, $row['bk_qty'], 1, 0, 'C');
            $pdf->Cell(25, 5, 'Rp ' . number_format($row['bk_harga'], 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(30, 5, 'Rp ' . number_format($row['bk_total'], 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(20, 5, $row['saldo_qty'], 1, 0, 'C');
            $pdf->Cell(25, 5, 'Rp ' . number_format($row['saldo_harga'], 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(30, 5, 'Rp ' . number_format($row['saldo_total'], 0, ',', '.'), 1, 1, 'C');
            $no++;
        }
    } else {
        $pdf->Cell(328, 8, 'Tidak ada data', 1, 1, 'C');
    }


    // Output PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="Laporan_Persediaan_' . date('M_Y') . '.pdf"');
    $pdf->Output('I');

    mysqli_close($koneksi);
    exit();
}



// Export Excel
function exportToExcelPersediaan($periode = null)
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

    $resultPMTH = getPMTH($periode);
    $resultPMTG = getPMTG($periode);

    // Membuat file Excel
    $filename = 'laporan_persediaan_' . $bulan_tahun . '.xls';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Header
    echo '
        <table border="0">
            <tr style="text-align: center;">
                <td colspan="13">
                    <span style="font-size: 20px; font-weight: bold;">KERUPUK ABADI ASIKIN <br></span>
                    <span style="font-size: 20px; font-weight: bold;">LAPORAN PERSEDIAAN <br></span>
                    <span style="font-size: 20px; font-weight: bold;">PERIODE ' . strtoupper($bulan_tahun) . '<br><br></span>
                </td>
            </tr>
        </table>
    ';

    // Tabel Produk Mentah
    echo '<span style="font-weight: bold; font-size: 16px">PERSEDIAAN BARANG DALAM PROSES (PRODUK MENTAH)</span> <br>';

    echo '<table border="1">';
    echo '<thead>
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
          <tbody>';

    $no = 1;
    while ($row = $resultPMTH->fetch_assoc()) {
        echo '<tr>
                <td style="text-align: center;">' . $no . '</td>
                <td>' . date("d M Y", strtotime($row['tanggal'])) . '</td>
                <td>' . $row['no_invoice'] . '</td>
                <td>' . $row['keterangan'] . '</td>
                <td>' . $row['bm_qty'] . '</td>
                <td>Rp ' . number_format($row['bm_harga'], 0, ',', '.') . '</td>
                <td>Rp ' . number_format($row['bm_total'], 0, ',', '.') . '</td>
                <td>' . $row['bk_qty'] . '</td>
                <td>Rp ' . number_format($row['bk_harga'], 0, ',', '.') . '</td>
                <td>Rp ' . number_format($row['bk_total'], 0, ',', '.') . '</td>
                <td>' . $row['saldo_qty'] . '</td>
                <td>Rp ' . number_format($row['saldo_harga'], 0, ',', '.') . '</td>
                <td>Rp ' . number_format($row['saldo_total'], 0, ',', '.') . '</td>
              </tr>';
        $no++;
    }

    echo '</tbody></table>';

    echo '<br> <br>';

    // Tabel Produk Matang
    echo '<span style="font-weight: bold; font-size: 16px">PERSEDIAAN BARANG JADI (PRODUK MATANG)</span> <br>';

    echo '<table border="1">';
    echo '<thead>
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
          <tbody>';

    $no = 1;
    while ($row = $resultPMTG->fetch_assoc()) {
        echo '<tr>
                <td style="text-align: center;">' . $no . '</td>
                <td>' . date("d M Y", strtotime($row['tanggal'])) . '</td>
                <td>' . $row['no_invoice'] . '</td>
                <td>' . $row['keterangan'] . '</td>
                <td>' . $row['bm_qty'] . '</td>
                <td>Rp ' . number_format($row['bm_harga'], 0, ',', '.') . '</td>
                <td>Rp ' . number_format($row['bm_total'], 0, ',', '.') . '</td>
                <td>' . $row['bk_qty'] . '</td>
                <td>Rp ' . number_format($row['bk_harga'], 0, ',', '.') . '</td>
                <td>Rp ' . number_format($row['bk_total'], 0, ',', '.') . '</td>
                <td>' . $row['saldo_qty'] . '</td>
                <td>Rp ' . number_format($row['saldo_harga'], 0, ',', '.') . '</td>
                <td>Rp ' . number_format($row['saldo_total'], 0, ',', '.') . '</td>
              </tr>';
        $no++;
    }

    echo '</tbody></table>';

    mysqli_close($koneksi);
    exit();
}
