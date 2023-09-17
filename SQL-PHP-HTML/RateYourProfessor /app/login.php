<?php
	session_start();
	include('db.php');
?>
<html>
<head>
	<title>Login</title>
	<link href="rateStyle.css" rel="stylesheet" type="text/css"/>

</head>

<body>



<?php
	$message = "";
	$error = "";

	// Do they want to log out?
	if(isset($_GET['logout'])){
		session_unset();
	}
	
	// Do they want to log in?
	if(isset($_GET['email']) && isset($_GET['password'])){
		$sql = "SELECT * FROM student WHERE email = ?;";
		$statement = $pdo->prepare($sql);
		$statement->bindValue(1, $_GET['email']);
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Error:", $e;
		}
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		if($row){    // where is row coming from and what does it do. what does row mean?
		$hash = $row['password'];
			if(password_verify($_GET['password'], $hash)){		 // First parameter gets the password that was submitted, second parameter gets the hashed password from the database. The password_verify unhashes the password.
				$message .= "Welcome back";
				$_SESSION['email'] = $_GET['email'];
				$_SESSION['sId'] = $row['sId'];
				header("location: Rating.php");
				exit();				
			}else{
				$error .= "Password incorrect";
			}
		}else{
			$error .= "Email not found";
		}
	}

?>
<?php include("menu.php"); ?>
<hr>
<center>

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

</center>
</body>
</html>