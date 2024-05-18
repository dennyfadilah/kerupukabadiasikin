<?php

$location = '<script>window.location.replace("biaya-operasional")</script>';

// Tambah Data Biaya Operasional
if (isset($_POST['add_biaya_operasional'])) {
    if (addDataBiayaOperasional()) {
        pushNotif('success', 'Data Biaya Operasional Berhasil Ditambahkan');
        echo $location;
    } else {
        pushNotif('danger', 'Data Biaya Operasional Gagal Ditambahkan');
        echo $location;
    }
}

// Edit Data Biaya Operasional
if (isset($_POST['id_bo']) && isset($_POST['edit_biaya_operasional'])) {
    $id_bo = $_POST['id_bo'];
    if (editDataBiayaOperasional($id_bo)) {
        pushNotif('success', 'Data Biaya Operasional Berhasil Diubah');
        echo $location;
    } else {
        pushNotif('danger', 'Data Biaya Operasional Gagal Diubah');
        echo $location;
    }
}

// Hapus Data Biaya Operasional
if (isset($_POST['id_bo']) && isset($_POST['delete'])) {
    $id_bo = $_POST['id_bo'];
    if (deleteDataBiayaOperasional($id_bo)) {
        pushNotif('success', 'Data Biaya Operasional Berhasil Dihapus');
        echo $location;
    } else {
        pushNotif('danger', 'Data Biaya Operasional Gagal Dihapus');
        echo $location;
    }
}