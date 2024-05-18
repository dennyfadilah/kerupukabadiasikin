<?php

$location = '<script>window.location.replace("persediaan-kerupuk-matang")</script>';

// Tambah Data Kerupuk Matang
if (isset($_POST['add_kerupuk_matang'])) {
    if (addDataKerupukMatang()) {
        pushNotif('success', 'Data Kerupuk Matang Berhasil Ditambahkan');
        echo $location;
    } else {
        pushNotif('danger', 'Data Kerupuk Matang Gagal Ditambahkan');
        echo $location;
    }
}

// Edit Data Kerupuk Matang
if (isset($_POST['id_mtg']) && isset($_POST['edit_kerupuk_matang'])) {
    $id_mtg = $_POST['id_mtg'];
    if (editDataKerupukmatang($id_mtg)) {
        pushNotif('success', 'Data Kerupuk Matang Berhasil Diedit');
        echo $location;
    } else {
        pushNotif('danger', 'Data Kerupuk Matang Gagal Diedit');
        echo $location;
    }
}

// Hapus Data Kerupuk Matang
if (isset($_POST['id_mtg']) && isset($_POST['delete'])) {
    $id_mtg = $_POST['id_mtg'];
    if (deleteDataKerupukmatang($id_mtg)) {
        pushNotif('success', 'Data Kerupuk Matang Berhasil Dihapus');
        echo $location;
    } else {
        pushNotif('danger', 'Data Kerupuk Matang Gagal Dihapus');
        echo $location;
    }
}
