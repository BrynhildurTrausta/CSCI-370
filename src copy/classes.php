<?php
	session_start();
	include('db.php');

	$message = "";
	$error = "";


	// New class
	if(isset($_GET['new_class']) &&
		isset($_SESSION['email']) && 
		strpos($_SESSION['email'], '.edu') !== false){
		$col = $db->class;
		
		$doc = ["_id" => $_GET['new_class']];
		
		try{
			$insertOneResult = $col->insertOne($doc);
			$message .= "Class added!";
		} catch(Exception $e){
			$error .= "Something went wrong.";
		}

		
	}

	// New professor
	if(isset($_GET['new_professor']) &&
		isset($_SESSION['email']) && 
		strpos($_SESSION['email'], '.edu') !== false){
		$col = $db->professor;
		
		$doc = ["_id" => $_GET['new_professor']];
		
		try{
			$insertOneResult = $col->insertOne($doc);
			$message .= "Professor added!";
		} catch(Exception $e){
			$error .= "Something went wrong.";
		}

		
	}
?>

<html>
<head>
	<title>Add Classes</title>
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
<h1>Classes:</h1>

<?php
	$col = $db->class;
	$result = $col->find();
	echo '<table>';
	foreach($result as $class){
		echo "<tr><td>" . $class["_id"] . '</td></tr>';
	}
	echo '</table>';
?>

<hr>
<h2>New Class</h2>
<form method="GET" action="/classes.php">
	<label>Class Name:</label><input type="text" name="new_class"><br>
	<input type="submit" value="Create class">
</form>

<hr>
<h1>Professors:</h1>

<?php
	$col = $db->professor;
	$result = $col->find()
	echo '<table>'
	foreach($result as $class){
		echo "<tr><td>" . $class["_id"] . '</td></tr>';
	}
	echo '</table>';
?>

<hr>
<h2>New Professor</h2>
<form method="GET" action="/classes.php">
	<label>Professor Name:</label><input type="text" name="new_professor"><br>
	<input type="submit" value="Add Professor">
</form>

</body>
</html>