<?php

namespace PolishPostTracking;

/**
 * Soap header for WSS auth
 */
class WseAuthSoapHeader extends \SoapHeader
{

    /**
     * WSS namespace reference
     *
     * @var string
     */
    private $wss_ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';

    /**
     * Create WSS header with username and password
     *
     * @param $user
     * @param $pass
     * @param null $ns
     */
    function __construct($user, $pass, $ns = null)
    {

        if ($ns) {
            $this->wss_ns = $ns;
        }

        $Auth           = new \stdClass();
        $Auth->Username = new \SoapVar($user, XSD_STRING, null, $this->wss_ns, null, $this->wss_ns);
        $Auth->Password = new \SoapVar($pass, XSD_STRING, null, $this->wss_ns, null, $this->wss_ns);

        $UsernameToken                = new \stdClass();
        $UsernameToken->UsernameToken = new \SoapVar(
            $Auth,
            SOAP_ENC_OBJECT,
            null,
            $this->wss_ns,
            'UsernameToken',
            $this->wss_ns
        );

        $SecuritySv = new \SoapVar(
            new \SoapVar($UsernameToken, SOAP_ENC_OBJECT, null, $this->wss_ns, 'UsernameToken', $this->wss_ns),
            // data
            SOAP_ENC_OBJECT,
            null,
            $this->wss_ns,
            'Security',
            $this->wss_ns
        );

        parent::__construct($this->wss_ns, 'Security', $SecuritySv, true);
    }
}