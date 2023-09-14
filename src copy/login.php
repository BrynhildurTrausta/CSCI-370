<?php
	session_start();
	include('db.php');

	$message = "";
	$error = "";

	// Do they want to log out?
	if(isset($_GET['logout'])){
		session_unset();
	}
	
	// Do they want to log in?
	if(isset($_GET['email']) && isset($_GET['password'])){
		$col = $db->user;
		$doc = ["_id" => $_GET['email'],
				"password" => $_GET['password']];
		
		try{
			$result = $col->countDocuments($doc);
		} catch(Exception $e){
			$error .= "Something went wrong.";
		}

		if($result == 1){
			$message .= "Welcome back";
			$_SESSION['email'] = $_GET['email'];;
			header("Location: /");  // This redirects on successful login.
		}else{
			$error .= "Password incorrect or email not found.";
		}

	}

	// New account
	if(isset($_GET['new_email']) && isset($_GET['new_password'])){
		$col = $db->user;
		
		$doc = ["_id" => $_GET['new_email'],
				"password" => $_GET['new_password']];
		
		try{
			$insertOneResult = $col->insertOne($doc);
			$message .= "User added!";
		} catch(Exception $e){
			$error .= "Something went wrong.";
		}

		
	}
?>

<html>
<head>
	<title>Login</title>
</head>

<body>

<?php include("menu.php"); ?>

<?php
	if($error != ''){
		echo '<h2 style="color:red">' . $error . "</h2>";
	}
	if($message != ''){
		echo '<h2>' . $message . "</h2>";
	}
?>
<h1>Please login:</h1>

<form method="GET">
	<label>Email:</label><input type="text" name="email"><br>
	<label>Password:</label><input type="password" name="password"><br>
	<input type="submit" value="Log In">
</form>

<hr>
<h2>New User</h2>
<form method="GET" action="/login.php">
	<label>Email:</label><input type="text" name="new_email"><br>
	<label>Password:</label><input type="password" name="new_password"><br>
	<input type="submit" value="Create account">
</form>

</body>
</html>