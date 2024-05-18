<?php
require 'config/config.php';

function notifikasi()
{
    require_once 'views/notifikasi.php';
}

function pushNotif($type, $message)
{
    global $koneksi;

    $result = mysqli_query($koneksi, "INSERT INTO log_activity (type,message,is_read,created_at) VALUES ('$type','$message',0,NOW())");

    $push_message =  "<script>alert(`$message`)</script>";

    echo $result ? $push_message : $push_message;
}

function readAll()
{
    global $koneksi;

    $result = mysqli_query($koneksi, "UPDATE log_activity SET is_read = 1 WHERE is_read = 0");

    return $result ? true : false;
}
