<?php
declare(strict_types=1);

use DataValidator\StringValidator;

if(isset($_POST['addressOneFinal'])) {

    try {

        $addressOneFinal = isset($_POST['addressOneFinal']) ? (new StringValidator($_POST['addressOneFinal'], 1, 75))->getData() : null;
        $addressTwoFinal = isset($_POST['addressTwoFinal']) ? (new StringValidator($_POST['addressTwoFinal'], 1, 75))->getData() : null;
        $cityFinal = isset($_POST['cityFinal']) ? (new StringValidator($_POST['cityFinal'], 1, 25))->getData() : null;
        $stateFinal = isset($_POST['stateFinal']) ? (new StringValidator($_POST['stateFinal'], 2, 2))->getData() : null;
        $zipFinal = isset($_POST['zipFinal']) ? (new StringValidator($_POST['zipFinal'],  5, 10))->getData() : null;

        if(is_null($addressOneFinal)){
            throw new Exception("Invalid Address1");
        }

        if(is_null($cityFinal)){
            throw new Exception("Invalid City");
        }

        if(is_null($stateFinal)){
            throw new Exception("Invalid State");
        }

        if(is_null($zipFinal)){
            throw new Exception("Invalid Zip: Format As xxxxx OR xxxxx-xxxx");
        }

        $allowedStates = ["AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "DC", "FL", "GA", "HI", "ID", "IL", "IN",
        "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY",
        "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY"];

        if(!in_array($stateFinal, $allowedStates)){
            throw new Exception("Invalid State");
        }


        $zipParts = explode('-', $zipFinal);

        if(count($zipParts) !== 2 && count($zipParts) !== 1){
            throw new Exception("Invalid Zip: Format As xxxxx OR xxxxx-xxxxB");
        }

        $zip5Final = $zipParts[0];
        $zip4Final = isset($zipParts[1]) ? $zipParts[1] : null;

        if(strlen($zip5Final) !== 5){
            throw new Exception("Invalid Zip: Format As xxxxx OR xxxxx-xxxxC");
        }

        if(!is_null($zip4Final) && strlen($zip4Final) !== 4){
            throw new Exception("Invalid Zip: Format As xxxxx OR xxxxx-xxxxD");
        }

        $db->beginTransaction();

        $rebateId = $db->queryDatabase("
            INSERT INTO addressCollection.address
            ( dateAdded,  address1, address2, city, state, zip5, zip4 ) 
            VALUES ( CURRENT_TIMESTAMP, :address1, :address2, :city, :state, :zip5, :zip4 );",
            [
                ":address1" => $addressOneFinal,
                ":address2" => $addressTwoFinal,
                ":city" => $cityFinal,
                ":state" => $stateFinal,
                ":zip5" => $zip5Final,
                ":zip4" => $zip4Final,
            ]);

        if($rebateId === false){
            throw new Exception("Error Adding Address To Database");
        }

        $db->commitTransaction();
        $_SESSION['success'] = "Address Added.";
        header("Location: /");
        die();

    } catch(Exception $ex){
        $_SESSION['error'] = $ex->getMessage();
        if($db->inTransaction()){
            $db->rollbackTransaction();
        }

        $db->logError($ex->getMessage(), 'addressCollection');
    }

}