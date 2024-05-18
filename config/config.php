<?php
$env = parse_ini_file('.env');

$dbHost = $env['DB_HOST'];
$dbUser = $env['DB_USER'];
$dbPass = $env['DB_PASS'];
$dbName = $env['DB_NAME'];

$koneksi = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$koneksi) {
    die("<script>alert('Gagal tersambung dengan database.');</script>");
}

$dir = '/' . $env['FOLDER_DIRECT'];
