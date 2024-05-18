<?php

$location = '<script>window.location.replace("persediaan-kerupuk-mentah")</script>';


// Tambah Data Kerupuk Mentah
if (isset($_POST['add_kerupuk_mentah'])) {
    if (addDataKerupukMentah()) {
        pushNotif('success', 'Data Kerupuk Mentah Berhasil Ditambahkan');
        echo $location;
    } else {
        pushNotif('danger', 'Data Kerupuk Mentah Gagal Ditambahkan');
        echo $location;
    }
}

// Edit Data Kerupuk Mentah
if (isset($_POST['id_mth']) && isset($_POST['edit_kerupuk_mentah'])) {
    $id_mth = $_POST['id_mth'];
    if (editDataKerupukMentah($id_mth)) {
        pushNotif('success', 'Data Kerupuk Mentah Berhasil Diedit');
        echo $location;
    } else {
        pushNotif('danger', 'Data Kerupuk Mentah Gagal Diedit');
        echo $location;
    }
}

// Hapus Data Kerupuk Mentah
if (isset($_POST['id_mth']) && isset($_POST['delete'])) {
    $id_mth = $_POST['id_mth'];
    if (deleteDataKerupukMentah($id_mth)) {
        pushNotif('success', 'Data Kerupuk Mentah Berhasil Dihapus');
        echo $location;
    } else {
        pushNotif('danger', 'Data Kerupuk Mentah Gagal Dihapus');
        echo $location;
    }
}
