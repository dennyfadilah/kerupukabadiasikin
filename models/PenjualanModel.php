<?php

function getAllPenjualan($koneksi)
{
    $result = mysqli_query($koneksi, "SELECT * FROM penjualan");

    return $result;
}

function getIdPenjualan($koneksi)
{
    $result = mysqli_query($koneksi, "SELECT id_pj FROM penjualan ORDER BY id_pj DESC LIMIT 1");
    $row = mysqli_fetch_array($result);

    return $row;
}

function tambahPenjualan($koneksi, $data)
{
    extract($data); // Ekstrak nilai-nilai dari array $data menjadi variabel yang terpisah

    $no_invoice = 'AA' . $bulan . '-' . $tahun . '/' . $no;
    $subtotal = $kuantitas * $harga_kg;
    $diskon = intval($diskon);
    $harga_total = $subtotal - $diskon;

    // Check validasi untuk invoice
    $query = mysqli_query($koneksi, "SELECT no_invoice FROM penjualan WHERE no_invoice = '$no_invoice'");

    // Jika no. invoice sudah ada
    if (mysqli_num_rows($query) > 0) {
        return false;
    }

    // Insert data penjualan ke database
    else {
        $result = mysqli_query($koneksi, "INSERT INTO penjualan (tanggal, no_invoice, nama_pelanggan, jenis_produk, kuantitas, harga_kg, subtotal, diskon, harga_total) VALUES ('$tanggal', '$no_invoice', '$nama_pelanggan', '$jenis_produk', '$kuantitas', '$harga_kg', '$subtotal', '$diskon', '$harga_total')");

        if ($jenis_produk == 'Kerupuk Mentah') {
            $table = 'kerupuk_mentah';
            $id_column = 'id_mth';
        } else {
            $table = 'kerupuk_matang';
            $id_column = 'id_mtg';
        }

        // Saldo
        $sqlSaldo = mysqli_query($koneksi, "SELECT saldo_qty AS sqty, saldo_harga AS sharga, saldo_total AS stotal FROM $table ORDER BY $id_column DESC LIMIT 1");

        $row = mysqli_fetch_array($sqlSaldo); // mengambil data saldo dari database

        // Inisialisasi saldo qty dan total dengan 0
        $sqty = isset($row['sqty']) ? $row['sqty'] : 0;
        $stotal = isset($row['stotal']) ? $row['stotal'] : 0;

        $bk_harga = isset($row['sharga']) ? $row['sharga'] : 0;
        $bk_total = $kuantitas * $bk_harga;

        // Perhitungan saldo qty dan total
        $saldo_qty = $sqty + 0 - $kuantitas;
        $saldo_total = $stotal + 0 - $bk_total;
        $saldo_harga = $saldo_total / $saldo_qty;

        $kerupukQuery = mysqli_query($koneksi, "INSERT INTO $table(status, tanggal, no_invoice, keterangan, bk_qty, bk_harga, bk_total, saldo_qty, saldo_harga, saldo_total) VALUES ('Barang Keluar', '$tanggal', '$no_invoice', 'Penjualan', '$kuantitas', '$bk_harga', '$bk_total', '$saldo_qty', '$saldo_harga', '$saldo_total')");

        if ($result && $kerupukQuery) {
            return true;
        } else {
            return false;
        }
    }
}

function editPenjualan($koneksi, $id_pj, $data)
{
    extract($data); // Ekstrak nilai-nilai dari array $data menjadi variabel yang terpisah

    // Ambil data no. invoice lama
    $result = mysqli_query($koneksi, "SELECT no_invoice FROM penjualan WHERE id_pj = '$id_pj'");
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        $no_invoice_lama = $data['no_invoice'];

        // Check validasi untuk invoice
        if ($no_invoice == $no_invoice_lama) {
            // Update data
            $query = mysqli_query($koneksi, "UPDATE penjualan SET
            tanggal = '$tanggal',
            no_invoice = '$no_invoice',
            nama_pelanggan = '$nama_pelanggan',
            jenis_produk = '$jenis_produk',
            kuantitas = '$kuantitas',
            harga_kg = '$harga_kg',
            subtotal = '$subtotal',
            diskon = '$diskon',
            harga_total = '$harga_total'
            WHERE id_pj = '$id_pj'");

            return $query ? true : false; // Mengembalikan nilai true jika query berhasil, false jika gagal
        } else {
            // Jika no. invoice sudah ada
            echo '<script>alert("Nomor Invoice sudah ada dalam database.");</script>';
            return false;
        }
    }
}

function hapusPenjualan($koneksi, $id_pj)
{
    $result = mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_pj = '$id_pj'");

    return $result;
}
