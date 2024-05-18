<?php

require 'config/config.php';
function kerupukMatang()
{
    global $koneksi;

    $result = mysqli_query($koneksi, "SELECT * FROM kerupuk_matang");

    $idlasted = mysqli_query($koneksi, "SELECT id_mtg FROM kerupuk_matang ORDER BY id_mtg DESC LIMIT 1");
    $rowIdLasted = mysqli_fetch_array($idlasted);

    if ($result) {
        require_once "views/kerupukMatang.php";
    } else {
        echo mysqli_error($koneksi);
    }
}

function addDataKerupukMatang()
{
    global $koneksi;

    $tanggal = $_POST['tanggal'];
    $no_invoice = $_POST['no_invoice'];
    $keterangan = $_POST['keterangan'];

    // Barang Masuk
    $bm_qty = isset($_POST['bm_qty']) ? intval($_POST['bm_qty']) : 0;
    $bm_harga = isset($_POST['bm_harga']) ? intval($_POST['bm_harga']) : 0;
    $bm_total = $bm_qty * $bm_harga;

    // Barang Keluar
    $bk_qty = isset($_POST['bk_qty']) ? intval($_POST['bk_qty']) : 0;
    $bk_harga = isset($_POST['bk_harga']) ? intval($_POST['bk_harga']) : 0;
    $bk_total = $bk_qty * $bk_harga;

    // Status
    if ($bm_qty != 0) {
        $status = "Barang Masuk";
    } else {
        $status = "Barang Keluar";
    }

    // Saldo
    $sqlSaldo = mysqli_query($koneksi, "SELECT saldo_qty AS sqty, saldo_total AS stotal FROM kerupuk_matang ORDER BY id_mtg DESC LIMIT 1");

    $row = mysqli_fetch_array($sqlSaldo); // mengambil data saldo dari database

    // Inisialisasi saldo qty dan total dengan 0
    $sqty = isset($row['sqty']) ? $row['sqty'] : 0;
    $stotal = isset($row['stotal']) ? $row['stotal'] : 0;

    // Perhitungan saldo qty dan total
    $saldo_qty = $sqty + $bm_qty - $bk_qty;
    $saldo_total = $stotal + $bm_total - $bk_total;
    $saldo_harga = $saldo_total / $saldo_qty;

    if ($bm_qty > 0 && $bk_qty > 0) {
        echo '<script>alert("Hanya Bisa Menambahkan Satu Data (Barang Masuk atau Barang Keluar)!");</script>';
        return false;
    } else {
        // Insert data ke database
        $result = mysqli_query($koneksi, "INSERT INTO kerupuk_matang (status, tanggal, no_invoice, keterangan, bm_qty, bm_harga, bm_total, bk_qty, bk_harga, bk_total, saldo_qty, saldo_harga, saldo_total) VALUES ('$status', '$tanggal', '$no_invoice', '$keterangan', '$bm_qty', '$bm_harga', '$bm_total', '$bk_qty', '$bk_harga', '$bk_total', '$saldo_qty', '$saldo_harga', '$saldo_total')");

        return $result ? true : false;
    }
}

function editDataKerupukMatang($id_mtg)
{
    global $koneksi;

    $tanggal = $_POST['tanggal'];
    $no_invoice = $_POST['no_invoice'];
    $keterangan = $_POST['keterangan'];

    $bm_qty = $_POST['bm_qty'];
    $bm_harga = $_POST['bm_harga'];
    $bm_total = $bm_qty * $bm_harga;

    $bk_qty = $_POST['bk_qty'];
    $bk_harga = $_POST['bk_harga'];
    $bk_total = $bk_qty * $bk_harga;

    // Saldo
    $query = mysqli_query($koneksi, "SELECT saldo_qty AS sqty, saldo_total AS stotal FROM kerupuk_matang ORDER BY id_mtg DESC LIMIT 1,1");

    $row = mysqli_fetch_array($query);

    // Inisialisasi

    $sqty = isset($row['sqty']) ? $row['sqty'] : 0;
    $stotal = isset($row['stotal']) ? $row['stotal'] : 0;

    // Perhitungan saldo qty dan total
    $saldo_qty = null;
    $saldo_total = null;

    $bqty = ($bm_qty) ? $bm_qty : -$bk_qty;
    $btotal = ($bm_total) ? $bm_total : -$bk_total;

    $saldo_qty = $sqty + $bqty;
    $saldo_total = $btotal + $stotal;
    $saldo_harga = $saldo_total / $saldo_qty;

    $result = mysqli_query($koneksi, "UPDATE kerupuk_matang SET 
    tanggal = '$tanggal', 
    no_invoice = '$no_invoice', 
    keterangan = '$keterangan', 
    bm_qty = '$bm_qty', 
    bm_harga = '$bm_harga', 
    bm_total = '$bm_total', 
    bk_qty = '$bk_qty', 
    bk_harga = '$bk_harga', 
    bk_total = '$bk_total', 
    saldo_qty = '$saldo_qty', 
    saldo_harga = '$saldo_harga', 
    saldo_total = '$saldo_total'  
    WHERE id_mtg = '$id_mtg '");

    return $result ? true : false;
}

function deleteDataKerupukMatang($id_mtg)
{
    global $koneksi;

    $result = mysqli_query($koneksi, "DELETE FROM kerupuk_matang WHERE id_mtg = $id_mtg");

    return $result ? true : false;
}