<?php

// we want to make sure there are no errors of any kind, do not need this in production
error_reporting( E_ALL | E_STRICT );

require_once 'PolishPostTracking/Autoloder.php';

try {

	$PolishPostApi 		= new \PolishPostTracking\Api;
	$packageTracking 	= $PolishPostApi->checkPackage( '00259007733174854852' );

	print_r( $packageTracking  );

} catch( \PolishPostTracking\Exception $E ) {
	echo 'Error occurred';

	// in production inform admin by email, save to log file
	echo '<br> ' . $E->getMessage();
}