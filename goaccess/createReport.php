<?php
$report = $_GET['report'];

if(strlen($report) > 7){
   header("HTTP/1.1 404 Not Found");
   return;
}

error_log(shell_exec("whoami")." REQUESTED REPORT: ".$report);
if($report === "access"){
	shell_exec("logreport -a");
}
else if($report === "vhost"){
	shell_exec("logreport -v");
}
else{
	$output = "INVALID REQUEST. BOT SUSPECTED";
	error_log($output);
}
return;
?>