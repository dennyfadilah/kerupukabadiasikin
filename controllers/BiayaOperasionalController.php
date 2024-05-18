<?php

require 'config/config.php';

// Tampilkan Halaman Biaya Operasional
function biayaOperasional()
{
    global $koneksi;

    // $result = mysqli_query($koneksi, "SELECT * FROM biaya_operasional");
    $result = mysqli_query($koneksi, "SELECT 
    ROW_NUMBER() OVER (PARTITION BY nama_akun ORDER BY id_bo) AS urutan,
    id_bo,
    tanggal_bo,
    nama_akun,
    keterangan,
    jumlah 
  FROM 
    biaya_operasional");

    if ($result) {
        require_once 'views/biayaOperasional.php';
    } else {
        echo mysqli_error($koneksi);
    }
}

// Tampil Data Akun
function getNamaAkun()
{
    global $koneksi;

    $result = mysqli_query($koneksi, "SELECT DISTINCT nama_akun FROM kategori_akun");
    return $result;
}

// Tambah Data Biaya Operasional
function addDataBiayaOperasional()
{
    global $koneksi;

    $tanggal_bo = $_POST['tanggal_bo'];
    $nama_akun = $_POST['nama_akun'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];

    $result = mysqli_query($koneksi, "INSERT INTO biaya_operasional (tanggal_bo, nama_akun, keterangan, jumlah) VALUES ('$tanggal_bo', '$nama_akun', '$keterangan', '$jumlah')");

    return $result ? true : false;
}

// Edit Data Biaya Operasional
function editDataBiayaOperasional($id_bo)
{
    global $koneksi;

    $tanggal_bo = $_POST['tanggal_bo'];
    $nama_akun = $_POST['nama_akun'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];

    $result = mysqli_query($koneksi, "UPDATE biaya_operasional SET tanggal_bo = '$tanggal_bo', nama_akun = '$nama_akun', keterangan = '$keterangan', jumlah = '$jumlah' WHERE id_bo = $id_bo");

    return $result ? true : false;
}

// Hapus Data Biaya Operasional
function deleteDataBiayaOperasional($id_bo)
{
    global $koneksi;

    $result = mysqli_query($koneksi, "DELETE FROM biaya_operasional WHERE id_bo = $id_bo");

    return $result ? true : false;
}
