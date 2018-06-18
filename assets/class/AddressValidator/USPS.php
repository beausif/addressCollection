<?php
declare(strict_types=1);

namespace AddressValidator;


use Exception;

/**
 * Class USPS
 * @package AddressValidator
 */
class USPS
{

    /**
     * @var string
     */
    private $userId;

    /**
     * USPS constructor.
     * @param string $userId
     */
    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param string $addressOne
     * @param string $addressTwo
     * @param string $city
     * @param string $state
     * @param string $zipCode
     * @return string
     */
    public function validateAddress(string $addressOne, ?string $addressTwo, string $city, string $state, string $zipCode){

        $baseUrl = 'http://production.shippingapis.com/ShippingAPI.dll?API=Verify&XML=';

        $xmlString = "<AddressValidateRequest USERID='" . $this->userId . "'><Address><Address1>$addressOne</Address1>" .
        "<Address2>$addressTwo</Address2><City>$city</City><State>$state</State><Zip5>$zipCode</Zip5><Zip4></Zip4>" .
        "</Address></AddressValidateRequest>";

        return $this->sendCurlRequest($baseUrl . urlencode($xmlString));
    }

    /**
     * @param string $addressOne
     * @param string $addressTwo
     * @param string $city
     * @param string $state
     */
    public function zipCodeLookup(string $addressOne, string $addressTwo, string $city, string $state){

    }

    /**
     * @param string $zipCode
     */
    public function cityStateLookup(string $zipCode){

    }

    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    private function sendCurlRequest(string $url): string
    {
        for($attempts = 0; $attempts < 3; $attempts++){
            $curl_connection = curl_init( $url );
            curl_setopt( $curl_connection, CURLOPT_CONNECTTIMEOUT, 3 );
            curl_setopt( $curl_connection, CURLOPT_TIMEOUT, 5 );
            curl_setopt( $curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)" );
            curl_setopt( $curl_connection, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $curl_connection, CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $curl_connection, CURLOPT_FOLLOWLOCATION, 1 );
            $response = curl_exec( $curl_connection );
            curl_close( $curl_connection );

            if( $response !== false) {
                return $response;
            }

        }
        throw new Exception("USPS Connection Failed");
    }



}