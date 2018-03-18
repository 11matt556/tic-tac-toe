<?php
//pull in user store class

require "userStore.php";
$errorMessage = "false";

//validates post variables
//returns true or an error message

/*
function validate(){
	if( !isset($_POST['username']) || !isset($_POST['password'])){
		return "All fields are required.";		
	}

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(strlen($username) > 25){
		return "Your username cannot be longer than 25 characters.";
	}

	if(strlen($password) > 100){
		return "Your password cannot be longer than 100 characters.";
	}
	return true;
}
*/
function checkUser($username,$password){
	try {
		if(strlen($username) > 25){
		return "Your username cannot be longer than 25 characters.";
		}

		if(strlen($password) > 100){
		return "Your password cannot be longer than 100 characters.";
		}
		
		//instantiate user store with path to json file on disk
		//if file doesnt exist, this call will create it for us
		$store = new UserStore("/data/users.json");

		//check to see if the user exists
		if($store->getUser($username)){
			$user = $store->getUser($username); //Get user from the userstore. Contains hashed password, salt, etc
			$hash = hash("sha256",$password.$user['salt']); //Calculate hash
			
			if($hash === $user['password']){ //If hash matches then password is correct
				return true;
			}
			else{
				return "\"Incorrect password\"";
			}
		}
		else{
			return "\"Incorrect username\"";
		}
	} catch (Exception $e) {
		//if we encoutered any exceptions return false
		return false;
	}
	return true;
}

if(isset($_POST['comingBack'])){
	//make sure POST vars are valid
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = checkUser($username,$password);
	
	//if we didn't get a string, but got a boolean true
	if(is_bool($result) && $result){ //user is bool and bool is true
		//Check if the user name and password match
		//$username = $_POST['username'];
		//$password = $_POST['password'];
		//checkUser($username,$password); //Check user and pass and direct to phoneNumber.php if correct
		//echo $errorMessage;
		session_start();
		$_SESSION['valid'] = true;
		header('Location: ../numverify/phoneNumber.php');
	}
	else{
		if(is_String($result)){
			$errorMessage = $result;
		}
	}
}
?>



<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript">var errorMessage = <?php /*php executes this blob of code */echo $errorMessage; ?></script>
<style type="text/css">
	.error{
		border: 1px solid;
		color: red;
	}
</style>
<h1>Login</h1>
<p id="instructions">WHO ARE YOU?</p>

<div id="error" class="errorMessage" style="visibility: hidden;"></div>
<section>
	<form id="form" method="post" action="login.php">
		<label>Username: <input type="text" name="username" id="username"></label><br>
		<label>Password: <input type="password" name="password" id="password"></label><br>
		<input type="hidden" name="comingBack" value="1">
		<button id="submit" type="submit" name="submit">Submit</button>
	</form>
	<form method="post" action="register.php">
		<p>No acount? Register by clicking below, or login with guest/guest</p>
		<button>Register</button>
	</form>
</section>

<script type="text/javascript" src="login.js"></script>