<?php
require 'config/config.php';
require_once "models/PekerjaModel.php";

// Tampilkan Halaman Data Pekerja
function dataPekerja()
{
    global $koneksi;

    $result = getAllPekerja($koneksi);

    if ($result) {
        require_once "views/dataPekerja.php";
    } else {
        echo mysqli_error($koneksi);
    }
}

// Tambah Data Pekerja
function addDataPekerja()
{
    global $koneksi;

    $data = [
        'nama_pekerja' => $_POST['nama_pekerja'],
        'alamat' => $_POST['alamat'],
        'no_hp' => $_POST['no_hp'],
        'mulai_kerja' => $_POST['mulai_kerja'],
        'berakhir_kerja' => $_POST['berakhir_kerja'],
        'bagian' => $_POST['bagian']
    ];

    $result = tambahPekerja($koneksi, $data);

    return $result ? true : false;
}

// Edit Data Pekerja
function editDataPekerja($id_pekerja)
{
    global $koneksi;

    $data = [
        'nama_pekerja' => $_POST['nama_pekerja'],
        'alamat' => $_POST['alamat'],
        'no_hp' => $_POST['no_hp'],
        'mulai_kerja' => $_POST['mulai_kerja'],
        'berakhir_kerja' => $_POST['berakhir_kerja'],
        'bagian' => $_POST['bagian']
    ];

    $result = editPekerja($koneksi, $data, $id_pekerja);

    return $result ? true : false;
}

// Hapus Data Pekerja
function deleteDataPekerja($id_pekerja)
{
    global $koneksi;

    $result = hapusPekerja($koneksi, $id_pekerja);

    return $result ? true : false;
}
