<?php

require_once 'polish_post_tracking/autoloder.php';

$PolishPostApi 		= new \PolishPostTracking\Api;
$packageTracking 	= $PolishPostApi->checkPackage( '00259007733174854852' );

// apply description to event codes, so instead of P_D you get "Doręczenie" in "opisZdarzenia" property
\PolishPostTracking\EventMapper::applyMappingToCheckPackage( $packageTracking );

print_r( $packageTracking  );