<?php		
header('Content-type: application/json');
       session_start();
        if(!isset($_SESSION['valid']) || $_SESSION['valid'] === false){	//If no session is found return to login screen
                header("Location: /projects/numverify/login/",true,302);
                return;
        }


	$number = $_GET['number'];
	$response = file_get_contents("http://apilayer.net/api/validate?access_key=f694032aa7790dc40c75e6765ce177ea&number=$number&format=1");
	//error_log($response);
	if($response == null){
		http_response_code(400);
	}
	echo $response;
?>