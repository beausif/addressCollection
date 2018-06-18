<?php
declare(strict_types=1);

use AddressValidator\USPS;
use DataValidator\StringValidator;

require_once dirname(dirname(dirname(__DIR__))) . '/assets/assets.php';

try {

    $addressOne = isset($_POST['addressOne']) ? (new StringValidator($_POST['addressOne'], 1, 75))->getData() : null;
    $addressTwo = isset($_POST['addressTwo']) ? (new StringValidator($_POST['addressTwo'], 1, 75))->getData() : null;
    $city = isset($_POST['city']) ? (new StringValidator($_POST['city'], 1, 25))->getData() : null;
    $state = isset($_POST['state']) ? (new StringValidator($_POST['state'], 2, 2))->getData() : null;
    $zip = isset($_POST['zip']) ? (new StringValidator($_POST['zip'],  5, 10))->getData() : null;

    $invalidElements = [];

    if(is_null($addressOne)){
        $invalidElements[] = [ "element" => "#addressOne", "message" => "Address 1 Required" ];
    }

    if(is_null($city)){
        $invalidElements[] = [ "element" => "#city", "message" => "City Required" ];
    }

    if(is_null($state)){
        $invalidElements[] = [ "element" => "#state", "message" => "State Required" ];
    }

    if(is_null($zip)){
        $invalidElements[] = [ "element" => "#zip", "message" => "Zip Required" ];
    }

    if(!empty($invalidElements)){
        echo json_encode([
            'success' => false,
            'invalidElements' => $invalidElements
        ]);
        die();
    }

    $usps = new USPS($iniSettings[DATABASE_INI_SECTION]['uspsKey']);
    $addressXml = simplexml_load_string($usps->validateAddress($addressOne, $addressTwo, $city, $state, $zip));
    $addressJson = json_decode(json_encode($addressXml));

    if(isset($addressJson->Address->Error)){
        throw new Exception($addressJson->Address->Error->Description);
    }

    echo json_encode([
        'success' => true,
        'address' => $addressJson
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}