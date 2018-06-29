<?php

//Load the Libraries
include_once 'libraries/ussd/MoUssdReceiver.php';
include_once 'libraries/ussd/MtUssdSender.php';
include_once 'libraries/game.php';
include_once 'libraries/log.php';
ini_set('error_log', 'applogs/ussd-app-error.log');

$receiver = new MoUssdReceiver(); // Create the Receiver object

$receiverSessionId = $receiver->getSessionId();
session_id($receiverSessionId); //Use received session id to create a unique session
session_start();

$content = $receiver->getMessage(); // get the message content
$address = $receiver->getAddress(); // get the sender's address
$requestId = $receiver->getRequestID(); // get the request ID
$applicationId = $receiver->getApplicationId(); // get application ID
$encoding = $receiver->getEncoding(); // get the encoding value
$version = $receiver->getVersion(); // get the version
$sessionId = $receiver->getSessionId(); // get the session ID;
$ussdOperation = $receiver->getUssdOperation(); // get the ussd operation

logFile("[ content=$content, address=$address, requestId=$requestId, applicationId=$applicationId, encoding=$encoding, version=$version, sessionId=$sessionId, ussdOperation=$ussdOperation ]");

$gameoftoday = "Select Game";

//your logic goes here......
$responseMsg = array(
    "main" => "1.Cricket
                    2.Football
                    000.Exit",
    "cricket" => "Cricket of the day
                    1.Today
                    2.Tomorrow
                    999.Back",
    "football" => "Football of the day
                    1.Today
                    2.Tomorrow
                    999.Back",
    "result"    => $gameoftoday
);

// First Request for USSD Comes to mo-init here
logFile("Previous Menu is := " . $_SESSION['menu-Opt']); //Get previous menu number
if (($receiver->getUssdOperation()) == "mo-init") { //Send the main menu
    loadUssdSender($sessionId, $responseMsg["main"]);
    if (!(isset($_SESSION['menu-Opt']))) {
        $_SESSION['menu-Opt'] = "main"; //Initialize main menu
    }
}

if (($receiver->getUssdOperation()) == "mo-cont") {
    $menuName = null;
    $game = new GameNews;

    switch ($_SESSION['menu-Opt']) {
        case "main":
            switch ($receiver->getMessage()) {
                case "1":
                    $menuName = "cricket";
                    break;
                case "2":
                    $menuName = "football";
                    break;
                default:
                    $menuName = "main";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName; //Assign session menu name
            break;
        case "cricket":
            $_SESSION['menu-Opt'] = "cricket-hist"; //Set to cricket menu back
            switch ($receiver->getMessage()) {
                case "1":
                    $responseMsg['result'] = $game->getGameUSSD('cricket', 'today');
                    $menuName = 'result';
                    break;
                case "2":
                    $responseMsg['result'] = $game->getGameUSSD('cricket', 'tomorrow');
                    $menuName = 'result';
                    break;
                case "999":
                    $menuName = "main";
                    $_SESSION['menu-Opt'] = "main";
                    break;
                default:
                    $menuName = "main";
                    break;
            }
            break;
        case "football":
            $_SESSION['menu-Opt'] = "football-hist"; //Set to product menu back
            switch ($receiver->getMessage()) {
                case "1":
                    $responseMsg['result'] = $game->getGameUSSD('football', 'today');
                    $menuName = 'result';
                    break;
                case "2":
                    $responseMsg['result'] = $game->getGameUSSD('football', 'tomorrow');
                    $menuName = 'result';
                    break;
                case "999":
                    $menuName = "main";
                    $_SESSION['menu-Opt'] = "main";
                    break;
                default:
                    $menuName = "main";
                    break;
            }
            break;
        case "cricket-hist" || "football-hist":
            switch ($_SESSION['menu-Opt']) { //Execute menu back sessions
                case "cricket-hist":
                    $menuName = "cricket";
                    break;
                case "football-hist":
                    $menuName = "football";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName; //Assign previous session menu name
            break;
    }

    if ($receiver->getMessage() == "000") {
        $responseExitMsg = "Exit Program!";
        $response = loadUssdSender($sessionId, $responseExitMsg);
        session_destroy();
    } else {
        logFile("Selected response message := " . $responseMsg[$menuName]);
        $response = loadUssdSender($sessionId, $responseMsg[$menuName]);
    }

}

/* $menuName = 'result';
$responseMsg['result'] = $game->getGameUSSD('cricket', 'today'); */

/*
    Get the session id and Response message as parameter
    Create sender object and send ussd with appropriate parameters
 **/

function loadUssdSender($sessionId, $responseMessage)
{
    $password = "password";
    $destinationAddress = "tel:8801866742387";
    if ($responseMessage == "000") {
        $ussdOperation = "mt-fin";
    } else {
        $ussdOperation = "mt-cont";
    }
    $chargingAmount = "5";
    $applicationId = "APP_000001";
    $encoding = "440";
    $version = "1.0";

    try {
        // Create the sender object server url

        $sender = new MtUssdSender("http://localhost:7000/ussd/send/");   // Application ussd-mt sending http url
        // $sender = new MtUssdSender("https://localhost:7443/ussd/send/"); // Application ussd-mt sending https url
        $response = $sender->ussd(
            $applicationId,
            $password,
            $version,
            $responseMessage,
            $sessionId,
            $ussdOperation,
            $destinationAddress,
            $encoding,
            $chargingAmount
        );
        return $response;
    } catch (UssdException $ex) {
        //throws when failed sending or receiving the ussd
        error_log("USSD ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
        return null;
    }
}
?>