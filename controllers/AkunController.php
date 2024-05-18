<?php
require 'config/config.php';
require 'models/AkunModel.php';

function akun()
{
    global $koneksi;

    $result = getAllAkun();

    if ($result) {
        require_once 'views/akun.php';
    } else {
        echo mysqli_error($koneksi);
    }
}

function addDataAkun()
{

    $nama_akun = $_POST['nama_akun'];

    $result = addAkun($nama_akun);
    return $result ? true : false;
}

function editDataAkun($id_akun)
{
    $nama_akun = $_POST['nama_akun'];
    $result = editAkun($id_akun, $nama_akun);
    return $result ? true : false;
}

function deleteDataAkun($id_akun)
{

    $result = deleteAkun($id_akun);
    return $result ? true : false;
}
