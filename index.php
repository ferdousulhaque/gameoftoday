<?php

require 'vendor/autoload.php';

Flight::route('GET /getGame', function () {
    echo 'hello world!';
});

Flight::start();

?>