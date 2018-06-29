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
    $externalTrxId = "25609";
    $amount = "300";
    $applicationId = "APP_000010";
    $password = "8f57d2e8de06e6f2d6ee5da6107d0a4f";
    $subscriberId = "tel: 8801812345678";
    $currency = "BDT";
    $accountId = "8801812345678";
    $res = $charger->directDebit(
                $externalTrxId,
                $amount,
                $applicationId,
                $password,
                $subscriberId,
                $currency,
                $accountId
    );
} catch (ChargeException $ex) {
        //throws when failed sending or receiving the sms
    error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
}