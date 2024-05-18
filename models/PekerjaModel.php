<?php

function getAllPekerja($koneksi)
{
    $result = mysqli_query($koneksi, "SELECT * FROM data_pekerja");

    return $result;
}

function tambahPekerja($koneksi, $data)
{
    extract($data);

    $result = mysqli_query($koneksi, "INSERT INTO data_pekerja (nama_pekerja, alamat, no_hp, mulai_kerja, berakhir_kerja, bagian) VALUES ('$nama_pekerja', '$alamat', '$no_hp', '$mulai_kerja', '$berakhir_kerja', '$bagian')");

    return $result;
}

function editPekerja($koneksi, $data, $id_pekerja)
{
    extract($data);

    $result = mysqli_query($koneksi, "UPDATE data_pekerja SET
        nama_pekerja = '$nama_pekerja',
        alamat = '$alamat',
        no_hp = '$no_hp',
        mulai_kerja = '$mulai_kerja',
        berakhir_kerja = '$berakhir_kerja',
        bagian = '$bagian'
        WHERE id_pekerja = $id_pekerja");

    return $result;
}

function hapusPekerja($koneksi, $id_pekerja)
{
    $result = mysqli_query($koneksi, "DELETE FROM data_pekerja WHERE id_pekerja = $id_pekerja");

    return $result;
}
