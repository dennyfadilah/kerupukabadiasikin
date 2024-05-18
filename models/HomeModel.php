<?php
require 'config/config.php';

function getPersediaanMTH($periode)
{
    global $koneksi;

    $result = mysqli_query($koneksi, "
    SELECT
        SUM(saldo_qty) AS saldo_qty,
        SUM(saldo_harga) AS saldo_harga,
        SUM(saldo_total) AS saldo_total
    FROM
        kerupuk_mentah
    WHERE
        tanggal = '$periode'
    ");

    return $result;
}

function getPersediaanMTG($periode)
{
    global $koneksi;

    $result = mysqli_query($koneksi, "
    SELECT
        SUM(saldo_qty) AS saldo_qty,
        SUM(saldo_harga) AS saldo_harga,
        SUM(saldo_total) AS saldo_total
    FROM
        kerupuk_matang
    WHERE
        tanggal = '$periode'
    ");

    return $result;
}

function getPenjualanMTH($periode)
{
    global $koneksi;

    $getDataMTH = array();

    $resultPenjualanMTH = mysqli_query($koneksi, "
    SELECT
        SUM(kuantitas) AS kuantitas,
        tanggal,
        jenis_produk
    FROM
        penjualan
    WHERE
        DATE_FORMAT(tanggal, '%Y-%m') = DATE_FORMAT('$periode', '%Y-%m')
    AND
        jenis_produk = 'Kerupuk Mentah'
    GROUP BY
        tanggal, jenis_produk
    ");

    while ($row = mysqli_fetch_assoc($resultPenjualanMTH)) {
        $getDataMTH[] = $row;
    }

    return $getDataMTH;
}

function generateDataMTH($getDataMTH)
{
    $rangeDate = range(1, 31);
    $dataMTH = array();

    foreach ($rangeDate as $day) {
        $found = false;
        foreach ($getDataMTH as $data) {
            $date = date('d', strtotime($data['tanggal']));
            if ($day == $date) {
                $dataMTH[] = $data['kuantitas'];
                $found = true;
                break;
            }
        }
        if (!$found) {
            $dataMTH[] = null;
        }
    }

    return json_encode($dataMTH);
}

function getPenjualanMTG($periode)
{
    global $koneksi;

    $getDataMTG = array();

    $resultPenjualanMTG = mysqli_query($koneksi, "
    SELECT
        SUM(kuantitas) AS kuantitas,
        tanggal,
        jenis_produk
    FROM
        penjualan
    WHERE
        DATE_FORMAT(tanggal, '%Y-%m') = DATE_FORMAT('$periode', '%Y-%m')
    AND
        jenis_produk = 'Kerupuk Matang'
    GROUP BY
        tanggal, jenis_produk
    ");

    while ($row = mysqli_fetch_assoc($resultPenjualanMTG)) {
        $getDataMTG[] = $row;
    }

    return $getDataMTG;
}

function generateDataMTG($getDataMTG)
{
    $rangeDate = range(1, 31);
    $dataMTG = array();

    foreach ($rangeDate as $day) {
        $found = false;
        foreach ($getDataMTG as $data) {
            $date = date('d', strtotime($data['tanggal']));
            if ($day == $date) {
                $dataMTG[] = $data['kuantitas'];
                $found = true;
                break;
            }
        }
        if (!$found) {
            $dataMTG[] = null;
        }
    }

    return json_encode($dataMTG);
}
