<?php

//Write App Logs here
function logFile($rtn){
	$f=fopen("applogs/log.txt","a");
	fwrite($f, $rtn . "\n");
	fclose($f);
	}

?>