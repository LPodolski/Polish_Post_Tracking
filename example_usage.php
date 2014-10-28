<?php

// we want to make sure there are no errors of any kind, do not need this in production
error_reporting(E_ALL | E_STRICT);

require_once 'PolishPostTracking/Autoloder.php';

try {

    $PolishPostApi   = new \PolishPostTracking\Api;
    $packageTracking = $PolishPostApi->checkPackage('testp0');

    var_dump($packageTracking);

} catch (\PolishPostTracking\Exception $E) {

    // in production inform admin by email, save to log file
    echo $E->getMessage();
}

