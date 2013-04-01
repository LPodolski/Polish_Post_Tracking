<?php

namespace PolishPostTracking;

/**
 * Polish post tracking API. Retrieve information about package.
 *
 * More info about API and documentation can be found on: http://www.poczta-polska.pl/webservices/
 */
class Api {

	/**
	 * Request ok
	 */
	const STATUS_OK 						= 0;

	/**
	 * Error: passed too many packages
	 */
	const STATUS_ERROR_TOO_MANY_PACKAGES 	= -1;

	/**
	 * Error: no right to check many packages
	 */
	const STATUS_ERROR_MANY_PACKAGES 		= -2;

	/**
	 * Error: wrong dates
	 */
	const STATUS_ERROR_WRONG_DATES 			= -3;

	/**
	 * Error: other undefined error
	 */
	const STATUS_ERROR_OTHER				= -99;

	/**
	 * SOAP handle
	 *
	 * @var SoapClient
	 */
	private $Soap;

	/**
	 * Constructor. Connect to API.
	 *
	 * You make small amount of requests, you can use anonymous account to which credentials are set as default.
	 * However, if you will request large amount of data you should apply for special credentials.
	 *
	 * @param    string $_apiLogin           sledzeniepp is default login for anonymous requests
	 * @param    string $_apiPassword        PPSA        is default password for anonymous request
	 * @throws 	 Exception
	 */
	public function __construct( $_apiLogin = 'sledzeniepp', $_apiPassword = 'PPSA' ) {

		$wsdlPath 	= __DIR__ . DIRECTORY_SEPARATOR . 'polish_post_tracking_api.wsdl';
		$this->Soap = new \SoapClient( $wsdlPath );

		// add WSS auth SOAP header ( API needs this authentication method )
		$WssHeader = new WseAuthSoapHeader( $_apiLogin, $_apiPassword );
		$this->Soap->__setSoapHeaders( array( $WssHeader ) );

		if( ! $this->Soap ) {
			throw new Exception( 'Can not connect to Polish post API' );
		}
	}

	/**
	 * Get tracking information about package
	 *
	 * @param    $_packageNumber
	 * @throws 	\Exception
	 * @return    object
	 */
	public function checkPackage( $_packageNumber ) {

		$packageTracking = 	$this->Soap->sprawdzPrzesylke(array(
								'numer' => $_packageNumber
							));

		if( ! isset( $packageTracking->return ) ) {
			throw new \Exception("Polish post package tracking, response not contains return property");
		}

		$packageTracking = $packageTracking->return;

		if( $packageTracking->status !== self::STATUS_OK ) {
			throw new \Exception("Polish post package tracking, error in response, error code: $packageTracking->status");
		}

		return $packageTracking;
	}

}