Class to tracking package sent by Polish Post Office.
=====================================================
Klasa do śledzenia przesyłki wysłanej poprzez Poczte Polską.
------------------------------------------------------------------

Example usage ( also in example_usage.php file ):

  $PolishPostApi 		= new \PolishPostTracking\Api;
	$packageTracking 	= $PolishPostApi->checkPackage( '00259007733174854852' );

	// apply description to event codes, so instead of P_D you get "Doręczenie" in "opisZdarzenia" property
	\PolishPostTracking\EventMapper::applyMappingToCheckPackage( $packageTracking );

	print_r( $packageTracking  );

Example return:

http://pastebin.com/XkFQBxDG
