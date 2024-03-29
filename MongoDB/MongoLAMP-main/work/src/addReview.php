<?php
	session_start();
	include('db.php');

	$message = "";
	$error = "";


	// New review
	if(isset($_GET['review']) &&
		isset($_SESSION['email']) ){
		$col = $db->review;
		
		$doc = ["_id" =>$_GET['class_name'] . $_GET['prof_name'] . $_SESSION['email'],
			"class" => $_GET['class_name'],
			"prof" => $_GET['prof_name'],
			"rating" => $_GET['rating'],
			"review" => $_GET['review'],
			"student" => $_SESSION['email']
		];	
		
		try{
			$insertOneResult = $col->insertOne($doc);
			$message .= "Review added!";
		} catch(Exception $e){
			$error .= "Something went wrong.";
		}

		
	}
?>

<html>
<head>
	<title>Add Review</title>
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
<h2>New Review</h2></center>
<div style="display: absolute; margin-left: 90px;">
<form method="GET" action="/addReview.php">
	<label>Professor:</label><select name="prof_name">
		<?php
			$col = $db->professor;
			$result = $col->find();
			foreach($result as $p){
				echo '<option value="' . $p['_id'] . '">' . $p['_id'] . "</option>\n";
			}
		?>
		</select>
	<br>
	<label>Class:</label><select name="class_name"><br>
		<?php
			$col = $db->class;
			$result = $col->find();
			foreach($result as $p){
				echo '<option value="' . $p['_id'] . '">' . $p['_id'] . "</option>\n";
			}
		?>
	</select><br>
	<label>Rating:</label><select name="rating">
		<?php
			foreach([1,2,3,4,5] as $p){
				echo '<option value="' . $p . '">' . $p . "</option>\n";
			}
		?>
	</select><br>
	<label>Review:</label><input type="text" name="review"><br>
	<input type="submit" value="Submit Review!">
</form>


</div></div></div>
</body>
</html>