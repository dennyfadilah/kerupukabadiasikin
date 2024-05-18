<?php

function getPeriodPenjualan($koneksi, $periode)
{

    $result = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE DATE_FORMAT(tanggal, '%Y-%m') = '$periode'");

    return $result;
}
