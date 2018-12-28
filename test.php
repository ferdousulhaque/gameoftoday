<?php
include_once 'libraries/game.php';

$responseMsg;

$game = new GameNews();
$responseMsg = $game->getTest();

echo $responseMsg;

?>