<?php

require_once "models/HomeModel.php";

function home()
{
    $periode = date('Y-m-d');

    $resultMTH = getPersediaanMTH($periode);
    $resultMTG = getPersediaanMTG($periode);


    $getDataMTH = getPenjualanMTH($periode);
    $mth = generateDataMTH($getDataMTH);

    $getDataMTG = getPenjualanMTG($periode);
    $mtg = generateDataMTG($getDataMTG);

    require_once "views/home.php";
}
