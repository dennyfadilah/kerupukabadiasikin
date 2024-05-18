<?php

require 'config/config.php';
require_once "models/PenjualanModel.php";

// Tampilkan Halaman Penjualan
function penjualan()
{
    global $koneksi;

    $result = getAllPenjualan($koneksi);
    $rowIdLasted = getIdPenjualan($koneksi);

    if ($result) {
        require_once "views/penjualan.php";
    } else {
        echo mysqli_error($koneksi);
    }
}

// Tambah Data Penjualan 
function addDataPenjualan()
{
    global $koneksi;

    $data = [
        'tanggal' => $_POST['tanggal'],
        'bulan' => $_POST['bulan'],
        'tahun' => $_POST['tahun'],
        'no' => $_POST['no'],
        'nama_pelanggan' => $_POST['nama_pelanggan'],
        'jenis_produk' => $_POST['jenis_produk'],
        'kuantitas' => intval($_POST['kuantitas']),
        'harga_kg' => intval($_POST['harga_kg']),
        'diskon' => intval($_POST['diskon'])
    ];

    $result = tambahPenjualan($koneksi, $data);

    return $result ? true : false;
}

// Edit data penjualan
function editDataPenjualan($id_pj)
{
    global $koneksi;

    $data = [
        'tanggal' => $_POST['tanggal'],
        'bulan' => $_POST['bulan'],
        'tahun' => $_POST['tahun'],
        'no' => $_POST['no'],
        'no_invoice' => 'AA' . $_POST['bulan'] . '-' . $_POST['tahun'] . '/' . $_POST['no'],
        'nama_pelanggan' => $_POST['nama_pelanggan'],
        'jenis_produk' => $_POST['jenis_produk'],
        'kuantitas' => $_POST['kuantitas'],
        'harga_kg' => $_POST['harga_kg'],
        'subtotal' => $_POST['subtotal'],
        'diskon' => $_POST['diskon'],
        'harga_total' => $_POST['harga_total']
    ];

    $result = editPenjualan($koneksi, $id_pj, $data);

    return $result ? true : false;
}

// Hapus data penjualan
function deleteDataPenjualan($id_pj)
{
    global $koneksi;

    $result = hapusPenjualan($koneksi, $id_pj);

    return $result ? true : false;
}
