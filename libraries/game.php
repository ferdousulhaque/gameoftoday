<?php

class GameNews{

    private $split='';
    private $responseMsg='';

    static function getGame($split){
        if (sizeof($split) < 1) {
            $responseMsg = "Invalid message content";
        } else {
            $dbcon = mysqli_connect("localhost", "root", "", "gameoftoday");
            if ($dbcon === false) {
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            $game_type = (String)$split[0];
            //$game_day = (String)$split[1];
            $game_day = date("Y-m-d");
            $game_of_today_query = mysqli_query($dbcon, "SELECT * 
                                            FROM games 
                                            WHERE type='" . $game_type .
                                            "' AND gamedate='" . $game_day . "'");
            $game_of_today = mysqli_fetch_assoc($game_of_today_query);
            $responseMsg = "Game of Today:\n". $game_of_today['gameinfo'];
        }
        mysqli_close($dbcon);
        return $responseMsg;
    }

    /* static function getTest()
    {
        $dbcon = mysqli_connect("localhost", "root", "", "gameoftoday");
        if ($dbcon === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        
        $game_type = 'football';
        $game_day = '2018-06-28';
        $game_of_today_query = mysqli_query($dbcon, "SELECT * 
                                            FROM games 
                                            WHERE type='" . $game_type .
                                            "' AND gamedate='" . $game_day . "'");
        $game_of_today = mysqli_fetch_assoc($game_of_today_query);
        $responseMsg = $game_of_today['gameinfo'];
        mysqli_close($dbcon);
        return $responseMsg;
    } */

    static function getGameUSSD($type, $day)
    {
        if ($type != null) {
            $dbcon = mysqli_connect("localhost", "root", "", "gameoftoday");
            if ($dbcon === false) {
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            $game_type = $type;
            
            if($day == 'today'){
                $game_day = date("Y-m-d");
            }elseif ($day == 'tomorrow'){
                $game_day = date("Y-m-d");
            }

            $game_of_today_query = mysqli_query($dbcon, "SELECT * 
                                            FROM games 
                                            WHERE type='" . $game_type .
                                            "' AND gamedate='" . $game_day . "'");
            $game_of_today = mysqli_fetch_assoc($game_of_today_query);
            $responseMsg = "Game of ". $day .":\n" . $game_of_today['gameinfo'];
        }
        mysqli_close($dbcon);
        return $responseMsg;
    }
}

?>