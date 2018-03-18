var createReport = function(report){

	console.log(report);
	
	axios({ //Send request to createReport. MAKE SURE TO VERIFY SERVER SIDE
			method: 'post',
			url: 'https://howell-info.us/goaccess/createReport.php',
			params: {
				report: report
			},
			responseType: 'json'
		})
		.then(function (response) {
				//console.log(".then")
				window.location.href = "report.html"
		})
}

var onLoad = function() {
	var vhostButton = document.getElementById("vhost");
	var accessButton = document.getElementById("access");
	vhostButton.onclick = function(){createReport("vhost")}
	accessButton.onclick = function(){createReport("access")};


};
window.addEventListener("load",onLoad,false);