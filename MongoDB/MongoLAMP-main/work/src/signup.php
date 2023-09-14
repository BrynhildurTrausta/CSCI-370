<?php
	session_start();
	include('db.php');

	$message = "";
	$error = "";

	// Do they want to log out?
	if(isset($_GET['logout'])){
		session_unset();
	}

	// New account
	if(isset($_GET['new_email']) && isset($_GET['new_password'])){
		$col = $db->user;
		
		$doc = ["_id" => $_GET['new_email'],
				"password" => $_GET['new_password']];
		
		try{
			$insertOneResult = $col->insertOne($doc);
			$message .= "User added!";
			header("Location: login.php");  // This redirects on successful login.
		} catch(Exception $e){
			$error .= "Something went wrong.";
		}

		
	}
?>

<html>
<head>
	<title>Sign up</title>
	<link href="style.css" rel="stylesheet" type="text/css"/>

</head>

<body>

<?php include("menu.php"); ?>
<center>

<?php
	if($error != ''){
		echo '<h2 style="color:red">' . $error . "</h2>";
	}
	if($message != ''){
		echo '<h2>' . $message . "</h2>";
	}
?>

<hr>
<h1>New User</h1>
<form method="GET">
	<label>Email:</label><input type="text" name="new_email"><br>
	<label>Password:</label><input type="password" name="new_password"><br>
	<input type="submit" value="Create account">
</form>
</center>
</body>
</html>