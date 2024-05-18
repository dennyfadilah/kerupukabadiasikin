<?php

$folderPath = "controllers";

// Mendapatkan daftar file PHP dalam folder
$files = glob($folderPath . "/*.php");

foreach ($files as $file) {
    require_once $file;
}