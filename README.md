Class to tracking package sent by Polish Post Office.
=====================================================
Klasa do śledzenia przesyłki wysłanej poprzez Poczte Polską.
------------------------------------------------------------------

Example usage ( also in example_usage.php file ):

	require_once 'PolishPostTracking/Autoloder.php';

	try {

		$PolishPostApi   = new \PolishPostTracking\Api;
		$packageTracking = $PolishPostApi->checkPackage('testp0');

		var_dump($packageTracking);

	} catch (\PolishPostTracking\Exception $E) {

		// in production inform admin by email, save to log file
		echo $E->getMessage();
	}

Example return:

http://pastebin.com/XkFQBxDG

-----
Task it handles:
poczta polska, śledzenie poczta polska, php