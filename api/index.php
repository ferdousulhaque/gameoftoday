<?php

require 'vendor/autoload.php';

Flight::route('GET /getGame', function () {
    //echo 'hello world!';
    $pdo = new PDO("mysql:dbname=gameoftoday", "root");
    $fluent = new FluentPDO($pdo);
    $query = $fluent->from('games')->select(array('gameinfo', 'gamedate'));
        //->where('type', 'football')
        //->orderBy('gamedate DESC');
        //->limit(1);

    $row = $query->fetchAll(); 
    echo json_encode($row);
});

Flight::start();

?>