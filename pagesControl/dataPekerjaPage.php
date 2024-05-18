<?php

$location = '<script>window.location.replace("data-pekerja")</script>';

// Tambah Data Pekerja
if (isset($_POST['add_pekerja'])) {
    if (addDataPekerja()) {
        pushNotif('success', 'Data Pekerja Berhasil Ditambahkan');
        echo $location;
    } else {
        pushNotif('danger', 'Data Pekerja Gagal Ditambahkan');
        echo $location;
    }
}

// Edit Data Pekerja
if (isset($_POST['id_pekerja']) && isset($_POST['edit_pekerja'])) {
    $id_pekerja = $_POST['id_pekerja'];
    if (editDataPekerja($id_pekerja)) {
        pushNotif('success', 'Data Pekerja Berhasil Diubah');
        echo $location;
    } else {
        pushNotif('danger', 'Data Pekerja Gagal Diubah');
        echo $location;
    }
}

// Hapus Data Pekerja
if (isset($_POST['id_pekerja']) && isset($_POST['delete'])) {
    $id_pekerja = $_POST['id_pekerja'];
    if (deleteDataPekerja($id_pekerja)) {
        pushNotif('success', 'Data Pekerja Berhasil Dihapus');
        echo $location;
    } else {
        pushNotif('danger', 'Data Pekerja Gagal Dihapus');
        echo $location;
    }
}
