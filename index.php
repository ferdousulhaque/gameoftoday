<?php

require 'vendor/autoload.php';

Flight::route('GET /getGame', function () {
    //echo 'hello world!';
    $pdo = new PDO("mysql:dbname=gameoftoday", "root");
    $fluent = new FluentPDO($pdo);
    $query = $fluent->from('games')
        ->where('type', 'football')
        ->orderBy('gamedate DESC')
        ->limit(1);
    foreach ($query as $row) {
        echo "$row[gameinfo]\n";
    }
});

Flight::start();

?>