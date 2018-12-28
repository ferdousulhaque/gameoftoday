<?php

//Load the Libraries
include_once 'libraries/sms/SmsReceiver.php';
include_once 'libraries/sms/SmsSender.php';
include_once 'libraries/game.php';
include_once 'libraries/log.php';
ini_set('error_log', 'applogs/sms-app-error.log');

//First Step is to receive the SMS to the application
try {
    $receiver = new SmsReceiver(); // Create the Receiver object

    $content = $receiver->getMessage(); // get the message content
    $address = $receiver->getAddress(); // get the sender's address
    $requestId = $receiver->getRequestID(); // get the request ID
    $applicationId = $receiver->getApplicationId(); // get application ID
    $encoding = $receiver->getEncoding(); // get the encoding value
    $version = $receiver->getVersion(); // get the version

    //Log the received content
    logFile("[ content=$content, address=$address, requestId=$requestId, applicationId=$applicationId, encoding=$encoding, version=$version ]");

    //Initialize a variable & game object
    $responseMsg;
    $game = new GameNews();

    //Now split the SMS with space delimiter
    $split = explode(' ', $content);
    $responseMsg = $game->getGame($split);

    //Send the game result to the Customer via API
    $sender = new SmsSender("http://localhost:7000/sms/send");

    //sending One Message
    $applicationId = "APP_000001";
    $encoding = "0";
    $version = "1.0";
    $password = "password";
    $sourceAddress = "77000";
    $deliveryStatusRequest = "1";
    $charging_amount = ":15.75";
    $destinationAddresses = array("tel:8801866742387");
    $binary_header = "";
    $res = $sender->sms($responseMsg, 
                        $destinationAddresses, 
                        $password, 
                        $applicationId, 
                        $sourceAddress, 
                        $deliveryStatusRequest, 
                        $charging_amount, 
                        $encoding, 
                        $version, 
                        $binary_header
            );

    } catch (SmsException $ex) {
        //throws when failed sending or receiving the sms
        error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
    }
?>