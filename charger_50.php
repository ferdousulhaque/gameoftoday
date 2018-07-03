<?php

//Load the Libraries
include_once 'libraries/charging/ChargingLib.php';
include_once 'libraries/log.php';
ini_set('error_log', 'applogs/charging-app-error.log');

//First Step is to charge
try {

    //Set the Charged API Address here
    $charger = new ChargingLib("http://localhost:7000/caas/direct/debit");
    //Charging one customer
    $res = $charger->directDebit(50);
    $resp = json_decode($res, true);
    //echo 'Your Transaction ID is: '.$resp['externalTrxId'];
    header('Location: http://lara.local/gameoftoday/eComPage.php');

} catch (ChargeException $ex) {
        //throws when failed sending or receiving the sms
    error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
}