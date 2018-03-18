<?php		
header('Content-type: application/json');
       session_start();
        if(!isset($_SESSION['valid']) || $_SESSION['valid'] === false){	//If no session is found return to login screen
                header("Location: /projects/numverify/login/",true,302);
                return;
        }

	$address = $_GET['address'];
	//error_log($address);

	$myURL = 'https://maps.googleapis.com/maps/api/geocode/json?';   
    $options = array("key"=>"AIzaSyCrPKO63kHR_o60bXTQ6P1EpjXUgsxqVGU","address"=>$address,"sensor"=>"false");
    $myURL .= http_build_query($options,'','&');

    $response = file_get_contents($myURL) or die(print_r(error_get_last()));
	//error_log($response);
	if($response == null){
		http_response_code(400);
	}
	echo $response;
?>