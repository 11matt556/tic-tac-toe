<?php
$report = $_GET['reportType'];

if(strlen($report) > 7){
   header("HTTP/1.1 404 Not Found");
   return;
}

error_log(shell_exec("whoami")." REQUESTED REPORT: ".$report);

if($report === "default"){
	shell_exec('sudo logreport');
}
else{
	$output = "INVALID REQUEST. BOT SUSPECTED";
	error_log($output);
}
return;
?>