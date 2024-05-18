<?php

require_once "models/HomeModel.php";

function home()
{
    $periode = date('Y-m-d');

    $resultMTH = getPersediaanMTH($periode);
    $resultMTG = getPersediaanMTH($periode);


    $getDataMTH = getPenjualanMTH($periode);
    $mth = generateDataMTH($getDataMTH);

    $getDataMTG = getPenjualanMTG($periode);
    $mtg = generateDataMTH($getDataMTG);

    require_once "views/home.php";
}
