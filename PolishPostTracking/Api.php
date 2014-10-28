<?php

namespace PolishPostTracking;

/**
 * Polish post tracking API. Retrieve information about package.
 *
 * More info about API and documentation can be found on: http://www.poczta-polska.pl/webservices/
 */
class Api extends \SoapClient
{

    /**
     * Request ok
     */
    const STATUS_OK = 0;

    /**
     * Request ok, but there are more parcels with this id
     */
    const STATUS_OK_MORE_AVAILABLE = 1;

    /**
     * Error: passed too many packages
     */
    const STATUS_ERROR_TOO_MANY_PACKAGES = -1;

    /**
     * Error: no right to check many packages
     */
    const STATUS_ERROR_MANY_PACKAGES = -2;

    /**
     * Error: wrong dates
     */
    const STATUS_ERROR_WRONG_DATES = -3;

    /**
     * Error: other undefined error
     */
    const STATUS_ERROR_OTHER = -99;

    private $debug = true;

    private $debugData = array();

    /**
     * Constructor. Connect to API.
     *
     * You make small amount of requests, you can use anonymous account to which credentials are set as default.
     * However, if you will request large amount of data you should apply for special credentials.
     *
     * @param    string $_apiLogin    sledzeniepp is default login for anonymous requests
     * @param    string $_apiPassword PPSA        is default password for anonymous request
     *
     * @throws   Exception
     */
    public function __construct($_apiLogin = 'sledzeniepp', $_apiPassword = 'PPSA')
    {
        $settings = array();

        if ($this->debug) {
            $settings['trace'] = 1;
        }

        // get instance of \SoapClient
        $wsdlPath = __DIR__ . DIRECTORY_SEPARATOR . 'PolishPostTrackingApi.wsdl';
        parent::__construct($wsdlPath, $settings);

        // add WSS auth SOAP header ( API needs this authentication method )
        $WssHeader = new WseAuthSoapHeader($_apiLogin, $_apiPassword);
        $this->__setSoapHeaders(array($WssHeader));
    }

    /**
     * Get tracking information about package
     *
     * @param   $_packageNumber
     *
     * @throws  Exception
     * @return  object
     */
    public function checkPackage($_packageNumber)
    {

        $packageTracking = $this->sprawdzPrzesylkePl(
            array(
                'numer' => $_packageNumber
            )
        );

        if ($this->debug) {
            $this->debugData['lastSoapResponse'] = $this->__getLastResponse();
        }

        if (!isset($packageTracking->return)) {
            throw new Exception("Polish Post package tracking, response not contains return property");
        }

        $packageTracking = $packageTracking->return;


        $correctResponseFromApi = in_array(
            $packageTracking->status,
            array(self::STATUS_OK, self::STATUS_OK_MORE_AVAILABLE)
        );

        if ($correctResponseFromApi === false) {
            throw new Exception(
                "Polish Post package tracking, error in response, error code: $packageTracking->status"
            );
        }

        return $packageTracking;
    }

    public function getDebugData()
    {
        return $this->debugData;
    }

}