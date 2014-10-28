Class to tracking package sent by Polish Post Office.
=====================================================
Klasa do śledzenia przesyłki wysłanej poprzez Poczte Polską.
------------------------------------------------------------------

Example usage ( also in example_usage.php file ):

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

Example return:

http://pastebin.com/XkFQBxDG

-----
Task it handles:
poczta polska, śledzenie poczta polska, php