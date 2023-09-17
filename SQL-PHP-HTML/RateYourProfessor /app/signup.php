<?php
	include('db.php');
?>
<html>
<head>
	<title>Sign up</title>
	<link href="rateStyle.css" rel="stylesheet" type="text/css"/>

</head>

<body>



<?php
	$message = "";
	$error = "";

	// New account
	if(isset($_GET['new_email']) && isset($_GET['new_password'])){
		$sql = "INSERT INTO student (email,password) VALUES (?,?);";
		$statement = $pdo->prepare($sql);
		$hash = password_hash($_GET['new_password'], PASSWORD_DEFAULT);
		$statement->bindValue(1, $_GET['new_email']);
		$statement->bindValue(2, $hash);
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Error:", $e;
		}
		$row = $statement->rowCount();		// what does rowCount() do? How does it know that a row was added?
		if($row){
			$message .= "User added!";
			header("location: login.php");
			exit();
		}else{
			$error .= "Something went wrong.";
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
<h1>Please Sign Up:</h1>
<form method="GET">
	<label>Email:</label><input type="text" name="new_email"><br>
	<label>Password:</label><input type="password" name="new_password"><br>
	<input type="submit" value="Create account">
</form>
</center>
</body>
</html>