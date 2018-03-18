//shows or hides error box using CSS Styles
//sets message inside the box
var showError = function(msg) {
	var errorNode = document.getElementById("error");
	if(msg === "" || msg === false) {
		//hide error
		errorNode.style = "visibility: hidden;";
		return;
	}
	errorNode.innerText = msg;
	errorNode.style = "";
};

//validates data before wasting ths user's and server's time
//this is NOT security, this is convience 
//we will have to do the same checks on the server
var validate = function() {
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;


	if(username === "" || password === ""){
		showError("All fields are required.");
		return false;
	}

	if(username.length > 25){
		showError("Your username cannot be longer than 25 characters.");
		return false;
	}
	if(password.length > 100){
		showError("Your password cannot be longer than 100 characters.");
		return false;
	}
	//we're here, no errors, hide error box
	showError(false);

	return true;
};


var onSubmit = () =>{
	if(!validate()){
		return false;
	}

	var buttonNode = document.getElementById("submit");
	buttonNode.innerText = "Submitting, please wait...";

	return true;
};

var onLoad = () => {
	var formNode = document.getElementById("form");

	formNode.onsubmit = onSubmit;

	if (errorMessage){
		showError(errorMessage);
	}

};
window.addEventListener("load",onLoad,false);