var createReport = function(report){

	console.log(report);
	
	axios({ //Send request to createReport. MAKE SURE TO VERIFY SERVER SIDE
			method: 'get',
			url: 'https://howell-info.us/goaccess/createReport.php',
			params: {
				reportType: report
			},
			responseType: 'json'
		})
		.then(function (response) {
				//console.log(".then")
				window.location.href = "report.html"
		})
}

var onLoad = function() {
	var reportbutton = document.getElementById("report");
	reportbutton.onclick = function(){createReport("default")};


};
window.addEventListener("load",onLoad,false);