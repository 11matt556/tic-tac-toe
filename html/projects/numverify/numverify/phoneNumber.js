var button;
var form;
var input;
var output;
var loc;

var getInput = function () {
	input = form.value;
	console.log(input);
	checkNumber();
	console.log(loc)

}

var checkNumber = function () {
	if(input == "" || input == undefined){
		output.innerHTML = "Please input a number"	
	}
	else{
	axios({ //Send number to verify.php, which then sends a request to numverify
			method: 'get',
			url: 'https://howell-info.us/projects/numverify/numverify/verify.php',
			params: {
				number: input
			},
			responseType: 'json'
		})
		.then(function (response) {
			console.log(response);
			var isValid = function () {
				if (response.data.valid) {
					return "Valid";
				} else {
					return "Not Valid";
				}
			};

			output.innerHTML = ""; //Clear any old output
			var out = [];	//Buffer for output
		
			out.push("Number: " + isValid());
        
            if(response.data.country_name == "" || response.data.country_name === undefined ){
                out.push("Country: " + "Not available");
            }
            else{
			 out.push("Country: " + response.data.country_name);
			 placeSearch(response.data.country_name);
            }
		
			if(response.data.carrier == "" || response.data.carrier === undefined){
				out.push("Carrier: " + "Not available");
			}
			else{
				out.push("Carrier: " + response.data.carrier);
			}
		
			if(response.data.line_type == "" || response.data.line_type === undefined || response.data.line_type === null){
				
				out.push("Line Type: " + "Not available");
			}
			else{
				out.push("Line Type: " + response.data.line_type)
			}
		
			for (i = 0; i < out.length; i++) {
				output.innerHTML += out[i]; //insert 
				var newElement = document.createElement('br');
				output.appendChild(newElement); //new line
			}
			
		})
		.catch(function(error){
			console.log(error);
		});
	}
};

var placeSearch = function (addr) {
	//console.log(addr);
	if(addr !== undefined){ //If the 
	axios({
		method: 'get',
		url: 'https://howell-info.us/projects/numverify/numverify/verifyMap.php',
		params: {
			address: addr
		},
		responseType: 'json'
	})
	.then(function (response) {
		console.log(response.data.results[0].geometry.location)
		loc = response.data.results[0].geometry.location;
		displayMap(loc['lat'], loc['lng'])
	})
	}
	else{
		displayMap(51.508742, -0.120850)

	}
}

var displayMap = function (lat, long) {
	var mapProp = {
		center: new google.maps.LatLng(lat, long),
		zoom: 4,
	};
	var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}

var keyPress = function (e) {
	if (e.keyCode == 13) {
		getInput();
	}
}

var onLoad = function () {
	button = document.getElementById("submit");
	form = document.getElementById("telForm");
	output = document.getElementById("output");
	button.onclick = getInput;
	form.onkeypress = keyPress;
	placeSearch();
	
};

window.addEventListener("load", onLoad);