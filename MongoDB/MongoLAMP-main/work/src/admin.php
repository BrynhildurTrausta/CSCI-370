<?php
	session_start();
	include('db.php');

	$message = "";
	$error = "";

	// Do they want to log out?
	if(isset($_GET['logout'])){
		session_unset();
	}
	
	// New class
	if(isset($_GET['new_class']) 
		&& isset($_GET['email']) &&
		strpos($_SESSION['email'], '.edu') !== false){
		$col = $db->class;

		$doc = ["_id" => $_GET['new_class']];

		try{
			$insertOneResult = $col->insertOne($doc);
			$message .= "Class added!";
		} catch(Exception $e) {
			$error .= "Something went wrong";
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
		<title>Add classes</title>
		<link href="style.css" rel="stylesheet" type="text/css"/>

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

		<div class="div-outer">
			<div class="div-inner"><center>

				<h2>Add a Class:</h2>
				<form method="GET">
					<label>Class Name:</label><input type="text" name="new_class"><br>
					<input type="submit" value="Create class">
				</form>

				<h2>Classes:</h2>

				<?php
					$col = $db->class;
					$result = $col->find();
					echo '<table>';
					foreach($result as $class){
						echo "<tr><td>" . $class["_id"] . '</td></tr>';
					}
					echo '</table><br>';
				?>

			</center></div>


			<div class="div-inner"><center>

				<h2>Add a Professor:</h2>
				<form method="GET">
					<label>Professor Name:</label><input type="text" name="new_professor"><br>
					<input type="submit" value="Add Professor">
				</form>
				<h2>Professors:</h2>

				<?php
					$col = $db->professor;
					$result = $col->find();
					echo '<table>';
					foreach($result as $class){
						echo "<tr><td>" . $class["_id"] . '</td></tr>';
					}
					echo '</table><br>';
				?>

			</center></div>
		</div>
	</body>
</html>