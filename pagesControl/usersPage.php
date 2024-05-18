<?php

$location = '<script>window.location.replace("users")</script>';

// Tambah Data User
if (isset($_POST['add_user'])) {
    if (addDataUser()) {
        pushNotif('success', 'Data User Berhasil Ditambahkan');
        echo $location;
    } else {
        pushNotif('danger', 'Data User Gagal Ditambahkan');
        echo $location;
    }
}

// Edit Data User
if (isset($_POST['id_user']) && isset($_POST['edit_user'])) {
    $id_user = $_POST['id_user'];
    if (editDataUser($id_user)) {
        pushNotif('success', 'Data User Berhasil Diubah');
        echo $location;
    } else {
        pushNotif('danger', 'Data User Gagal Diubah');
        echo $location;
    }
}

// Hapus Data User
if (isset($_POST['id_user']) && isset($_POST['delete'])) {
    $id_user = $_POST['id_user'];
    if (deleteDataUser($id_user)) {
        pushNotif('success', 'Data User Berhasil Dihapus');
        echo $location;
    } else {
        pushNotif('danger', 'Data User Gagal Dihapus');
        echo $location;
    }
}
