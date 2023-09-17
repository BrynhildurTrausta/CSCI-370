
<html>
<head>
	<title>RateYourProfessor</title>
	<link href="rateStyle.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<?php include('db.php');?>

<center><img src="images/welcome.jpg" width="600px" height="300px">
<div style="display: flex; position: absolute; top: 60%; left: 50%; transform: translate(-50%, -50%);">
	<div style="border-radius: 20px; margin-left: 10px; height: 150px; background-color: #bdf; width: 400px; transition: .3s all ease;">
		<h1>Already have an account? <br> <a href="login.php">Log in</a> </h1></div>
	<div style="border-radius: 20px; margin-left: 10px; height: 150px; background-color: #bdf; width: 400px; transition: .3s all ease;">
		<h1>Start your Journey here<br>
	<a href="signup.php">Sign up for free</a> </h1></div>
</div></center>

<?php
	include('views.php');
	
?>

</body>
</html>



