<?php

class ChargingLib
{
    var $server;

    public function __construct($server)
    {
        $this->server = $server; // Assign server url
    }

    function directDebit(
                                //$externalTrxId,
                                $amount
                                //$applicationId,
                                //$password,
                                //$subscriberId,
                                //$currency,
                                //$accountId
                                //$paymentInstrumentName
    ) {
        $externalTrxId = "25609";
        //$amount = "300";
        $applicationId = "APP_000010";
        $password = "8f57d2e8de06e6f2d6ee5da6107d0a4f";
        $subscriberId = "tel: 8801812345678";
        $currency = "BDT";
        $accountId = "8801812345678";

        $arrayField = array(
            "externalTrxId" => $externalTrxId,
            "amount" => $amount,
            "applicationId" => $applicationId,
            "password" => $password,
            "subscriberId" => $subscriberId,
            "currency" => $currency,
            "accountId" => $accountId,
            "paymentInstrumentName" => "Mobile Account"
        );

        $jsonObjectFields = json_encode($arrayField);
        return $this->sendRequest($jsonObjectFields);
    }

    function balance(
        //$applicationId,
        //$password,
        //$subscriberId,
        //$currency,
        //$accountId,
        //$paymentInstrumentName
    ){
        $applicationId = "APP_000010";
        $password = "8f57d2e8de06e6f2d6ee5da6107d0a4f";
        $subscriberId = "tel: 8801812345678";
        $currency = "BDT";
        $accountId = "8801812345678";
        $paymentInstrumentName = "Mobile Account";

        $arrayField = array(
            "applicationId" => $applicationId,
            "password" => $password,
            "subscriberId" => $subscriberId,
            "currency" => $currency,
            "accountId" => $accountId,
            "currency" => $currency,
            "paymentInstrumentName" => "Mobile Account"
        );

        $jsonObjectFields = json_encode($arrayField);
        return $this->sendRequest($jsonObjectFields);
    }

    private function sendRequest($jsonObjectFields)
    {
        $ch = curl_init($this->server);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonObjectFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch); //Send request and get response
        curl_close($ch);
        return $this->handleResponse($res);
    }

    private function handleResponse($resp)
    {
        if ($resp == "") {
            //throw new UssdException("Server URL is invalid", '500');
        } else {
            return $resp;
        }
    }
}

class ChargeException extends Exception{ // Charging Exception Handler

    var $code;
    var $response;
    var $statusMessage;

    public function __construct($message, $code, $response = null){
        parent::__construct($message);
        $this->statusMessage = $message;
        $this->code = $code;
        $this->response = $response;
    }

    public function getStatusCode(){
        return $this->code;
    }

    public function getStatusMessage(){
        return $this->statusMessage;
    }

    public function getRawResponse(){
        return $this->response;
    }

}
?>