<?php

$location = '<script>window.location.replace("akun")</script>';

// Tambah Data Akun
if (isset($_POST['add_akun'])) {
    if (addDataAkun()) {
        pushNotif('success', 'Data Akun Berhasil Ditambahkan');
        echo $location;
    } else {
        pushNotif('danger', 'Data Akun Gagal Ditambahkan');
        echo $location;
    }
}

// Edit Data Akun
if (isset($_POST['id_akun']) && isset($_POST['edit_akun'])) {
    $id_akun = $_POST['id_akun'];
    if (editDataAkun($id_akun)) {
        pushNotif('success', 'Data Akun Berhasil Diubah');
        echo $location;
    } else {
        pushNotif('danger', 'Data Akun Gagal Diubah');
        echo $location;
    }
}

// Hapus Data Akun
if (isset($_POST['id_akun']) && isset($_POST['delete'])) {
    $id_akun = $_POST['id_akun'];
    if (deleteDataAkun($id_akun)) {
        pushNotif('success', 'Data Akun Berhasil Dihapus');
        echo $location;
    } else {
        pushNotif('danger', 'Data Akun Gagal Dihapus');
        echo $location;
    }
}
