<?php

$location = '<script>window.location.replace("penjualan")</script>';

// Tambah Data Penjualan
if (isset($_POST['add_penjualan'])) {
    if (addDataPenjualan()) {
        pushNotif('success', 'Data Penjualan Berhasil Ditambahkan');
        echo $location;
    } else {
        pushNotif('danger', 'Data Penjualan Gagal Ditambahkan');
        echo $location;
    }
}

// Edit Data Penjualan
if (isset($_POST['id_pj']) && isset($_POST['edit_penjualan'])) {
    $id_penjualan = $_POST['id_pj'];
    if (editDataPenjualan($id_penjualan)) {
        pushNotif('success', 'Data Penjualan Berhasil Diubah');
        echo $location;
    } else {
        pushNotif('danger', 'Data Penjualan Gagal Diubah');
        echo $location;
    }
}

// Hapus Data Penjualan
if (isset($_POST['id_pj']) && isset($_POST['delete'])) {
    $id_penjualan = $_POST['id_pj'];
    if (deleteDataPenjualan($id_penjualan)) {
        pushNotif('success', 'Data Penjualan Berhasil Dihapus');
        echo $location;
    } else {
        pushNotif('danger', 'Data Penjualan Gagal Dihapus');
        echo $location;
    }
}
