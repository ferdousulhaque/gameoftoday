<?php

//Load the Libraries
include_once 'libraries/charging/ChargingLib.php';
include_once 'libraries/log.php';
ini_set('error_log', 'applogs/charging-app-error.log');

//First Step is to charge
try {

    //Set the Charged API Address here
    $balance = new ChargingLib("http://localhost:7000/caas/balance/query");

    $res = $balance->balance();
    $resp = json_decode($res, true);
    echo 'Your Current Balance is: ' . $resp['chargeableBalance'];
} catch (ChargeException $ex) {
        //throws when failed sending or receiving the sms
    error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
}