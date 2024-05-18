<?php

function getProduk($koneksi, $periode)
{
    $result = mysqli_query($koneksi, "
    SELECT 
        SUM(CASE WHEN jenis_produk = 'Kerupuk Mentah' THEN subtotal ELSE 0 END) AS subtotal_mentah,
        SUM(CASE WHEN jenis_produk = 'Kerupuk Matang' THEN subtotal ELSE 0 END) AS subtotal_matang,
        SUM(diskon) AS total_diskon
    FROM 
        penjualan 
    WHERE 
        DATE_FORMAT(tanggal, '%Y-%m') = '$periode'
    ");

    return $result;
}

function getBPPMTH($koneksi, $periode)
{
    $result = mysqli_query($koneksi, "
    SELECT 
        SUM(CASE WHEN status = 'Barang Keluar' THEN bk_total ELSE 0 END) AS bpp_mentah
    FROM
        kerupuk_mentah
    WHERE
        DATE_FORMAT(tanggal, '%Y-%m') = '$periode'
    ");

    return $result;
}

function getBPPMTG($koneksi, $periode)
{
    $result = mysqli_query($koneksi, "
    SELECT 
        SUM(CASE WHEN status = 'Barang Keluar' THEN bk_total ELSE 0 END) AS bpp_matang
    FROM
        kerupuk_matang
    WHERE
        DATE_FORMAT(tanggal, '%Y-%m') = '$periode'
    ");

    return $result;
}

function getBO($koneksi, $periode)
{
    $result = mysqli_query($koneksi, "
    SELECT 
        nama_akun,
        SUM(jumlah) AS jumlah
    FROM
        biaya_operasional
    WHERE
        DATE_FORMAT(tanggal_bo, '%Y-%m') = '$periode'
    GROUP BY
        nama_akun
    ");

    return $result;
}

function getJumlahBO($koneksi, $periode)
{
    $result = mysqli_query($koneksi, "
    SELECT
        SUM(jumlah) AS jumlah
    FROM
        biaya_operasional
    WHERE
        DATE_FORMAT(tanggal_bo, '%Y-%m') = '$periode'
    ");

    return $result;
}
