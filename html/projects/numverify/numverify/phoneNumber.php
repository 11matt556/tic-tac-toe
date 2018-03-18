<?php
       session_start();
        if(!isset($_SESSION['valid']) || $_SESSION['valid'] === false){	//If no session is found return to login screen
                header("Location: /projects/numverify/login/login.php",true,302);
                return;
        }
?>

<!doctype html>
<html>
<head>
    <title>Verify Phone Number</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Matthew Howell">    
    <link rel="shortcut icon" href="favicon.ico">  
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
    <!-- Global CSS -->
    <link rel="stylesheet" href="../../../assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="../../../assets/plugins/font-awesome/css/font-awesome.css">
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="../../../assets/css/styles.css">
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="http://howell-info.us">Howell-Info</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <ul class="nav navbar-nav">
        <li><a href="http://howell-info.us">Home</a></li>
		  <li><a href="../login/">Login</a></li>
		  <li><a href="../login/logout.php">Logout</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
</div>
 <div class="container">
		<section class="about section">
			<div class="section-inner">
				<h2 class="heading">Number Verifier</h2>
				<div class="content">
					<div class="desc text-left">
					<p>Built with the numverify API. Number must include full area and country code.</p>
					</div>
				</div><!--//content-->
			</div>
         </section>

	 <div style="text-align: center;margin: 20px"> <!--MAP and Output. Center all this-->
		 <div id="googleMap" style="width:95%;height:400px"> </div>
		 <div id="search_area" style="text-align: center;margin-top: 20px;margin-bottom: 20px">
        	<input id="telForm" type="number" class="form" placeholder="Number"></input>
            <button id="submit" type="submit" class="btn btn-cta-primary">Submit</button>
        </div>
		<div style="display: inline-block">
		 	<div id="output" style="text-align: left"> </div>
		</div>
	</div>
</div>  <!-- container -->
<script src="../../../js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="../../../js/bootstrap.js" type="text/javascript"></script>
<script src="phoneNumber.js" type="text/javascript"></script>
<script src="../../../js/axios.min.js" type="text/javascript"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnD-iJLoSUxsEBcApXMk7surx6WLj-R90&callback=placeSearch"></script>

</body>
</html>
