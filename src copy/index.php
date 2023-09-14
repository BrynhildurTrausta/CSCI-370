<?php
	session_start();
	include('db.php');
?>
<html>
<head>
	<title>Mongo RateYourProfessor</title>
</head>

<body>

<?php include("menu.php"); ?>

<?php


?>

<h1>Reviews for a class</h1>
<form method="GET" action="/index.php">
	<label>Class:</label><select name="class_name"><br>
		<?php
			$col = $db->class;
			$options = ['sort' => ['_id' => 1]];
			$result = $col->find([], $options);
			foreach($result as $p){
				echo '<option value="' . $p['_id'] . '">' . $p['_id'] . "</option>\n";
			}
		?>
	</select>
	<input type="submit" value="Get Reviews!">
</form>
<?php
	if(isset($_GET['class_name'])){
		$col = $db->reviews;
		$doc = ["class" => $_GET['class_name']];
		$result = $col->find($doc);
		echo 'Class: ' . $_GET['class_name'] . "<br>";
		$rarray = $result->toArray();
		if(count($rarray) == 0){
			echo "No reviews for that class.<br>";
		}else{
			$rating_sum = 0;
			echo '<table border="1">';
			echo "<tr><th>Professor</th><th>Rating</th><th>Review</th></tr>\n";
			foreach($rarray as $r){
				echo "<tr>";
				echo "<td>" . $r["pro"] . '</td>';
				echo "<td>" . $r["rating"] . '</td>';
				$rating_sum += $r["rating"]; 
				echo "<td>" . $r["review"] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo 'Average Rating: ' . $rating_sum / count($rarray) . '<br>';
		}
	}else{
		echo "No class specified.";
	}

?>

</body>
</html>