<?php

require 'config/config.php';

function getPMTH($periode)
{

    global $koneksi;

    $result = mysqli_query($koneksi, "SELECT * FROM kerupuk_mentah WHERE DATE_FORMAT(tanggal, '%Y-%m') = '$periode'");

    return $result;
}

function getPMTG($periode)
{

    global $koneksi;

    $result = mysqli_query($koneksi, "SELECT * FROM kerupuk_matang WHERE DATE_FORMAT(tanggal, '%Y-%m') = '$periode'");
    return $result;
}
