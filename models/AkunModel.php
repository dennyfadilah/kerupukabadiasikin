<?php

require "config/config.php";

function getAllAkun()
{
    global $koneksi;

    $result = mysqli_query($koneksi, "SELECT * FROM kategori_akun");
    return $result;
}

function addAkun($nama_akun)
{
    global $koneksi;

    $result = mysqli_query($koneksi, "INSERT INTO kategori_akun (nama_akun) VALUES ('$nama_akun')");
    return $result;
}

function editAkun($id_akun, $nama_akun)
{
    global $koneksi;

    $result = mysqli_query($koneksi, "UPDATE kategori_akun SET nama_akun = '$nama_akun' WHERE id_akun = $id_akun");
    return $result;
}

function deleteAkun($id_akun)
{
    global $koneksi;

    $result = mysqli_query($koneksi, "DELETE FROM kategori_akun WHERE id_akun = $id_akun");

    return $result;
}