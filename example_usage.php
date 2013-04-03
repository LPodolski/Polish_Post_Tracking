<?php

// we want to make sure there are no errors of any kind, do not need this in production
error_reporting( E_ALL | E_STRICT );

require_once 'PolishPostTracking/Autoloder.php';

$PolishPostApi 		= new \PolishPostTracking\Api;
$packageTracking 	= $PolishPostApi->checkPackage( '00259007733174854852' );

// apply description to event codes, so instead of P_D you get "Doręczenie" in "opisZdarzenia" property
\PolishPostTracking\EventMapper::applyMappingToCheckPackage( $packageTracking );

print_r( $packageTracking  );