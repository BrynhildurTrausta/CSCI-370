<?php
	session_start();
	include('db.php');
?>
<html>
<head>
	<title>Rating</title>
	<link href="rateStyle.css" rel="stylesheet" type="text/css"/>

</head>

<body>



<?php
	// Do they want to log out?
	if(isset($_GET['logout'])){
		session_unset();
	}
?>
<?php include("menu.php"); ?>
<hr>
<center>

<?php
// Department column on page
	$sql = "SELECT * FROM department;";

	$statement = $pdo->prepare($sql);
	try{
		$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}

	echo '<div style="display: flex; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">';
	echo '<div style="border-radius: 20px; margin-left: 10px; height: 550px; border: 1px solid #fff; width: 460px; transition: .3s all ease;">';

	echo '<h2 style="color: black;">Departments</h2>';

	echo "<center><table class=\"styled-table\" style=\"width: 400px\" border=\"1\">\n";
		echo '<tr>';
		echo '<th>Department</th>';
		echo '<th>Number of Ratings</th>';
		echo '<th>Average Rating</th>';
		echo '</tr>';
	while($row = $statement->fetch(PDO::FETCH_ASSOC)){
		echo '<tr>';
		echo '<td>',$row['department'],"</td>\n";
		echo '<td>',$row['nofRating'],"</td>\n";
		echo '<td>',$row['avgD'],"</td>\n";
		echo '</tr>';
		//var_dump($row);
	}
	echo '</table></center></div>';

?>



<?php

// The Professors column on the page
	$sql = "SELECT * FROM professor;";

	$avg = "SELECT AVG(rating.rate) FROM professor, rating WHERE professor.pId = rating.profId;";

	$statement = $pdo->prepare($sql);
	try{
		$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}

	echo '<div style="border-radius: 20px; margin-left: 10px; height: 550px; border: 1px solid #fff; width: 460px; transition: .3s all ease;">';

	echo '<h2 style="color: black;">Professors</h2>';

	echo "<center><table class=\"styled-table\" style=\"width: 400px\" border=\"1\">\n";
		echo '<tr>';
		echo '<th>Name</th>';
		echo '<th>Department</th>';
		echo '<th>Average Rating</th>';
		echo '</tr>';
	while($row = $statement->fetch(PDO::FETCH_ASSOC)){
		echo '<tr>';
		echo '<td>',$row['name'],"</td>\n";
		echo '<td>',$row['department'],"</td>\n";
		echo '<td>',$row['avgP'],"</td>\n";
		echo '</tr>';
		//var_dump($row);
	}
	echo '</table></center></div>';

?>


<?php

// The Search for professor on the page
	$sql = "SELECT * FROM professor;";

	$statement = $pdo->prepare($sql);
	try{
		$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}
	$results = $statement->fetchAll();

// The Add a rating column on the page 

	echo '<div style="display: flex; position: absolute; top: 92%; left: 50%; transform: translate(-50%, -50%);">';
	echo '<div style="border-radius: 20px; margin-left: 10px; height: 50px; width: 1000px; transition: .3s all ease;">';

	if(isset($_GET['pId']) && isset($_GET['rate']) && isset($_GET['comment'])){
		$sql = "INSERT INTO rating (profId, studId, rate, comment) VALUES (?, ?, ?, ?);
				UPDATE professor SET avgP = (SELECT AVG(rate) FROM rating WHERE profId = ?)WHERE pId = ?;
				UPDATE rating SET rDepartment = (SELECT department FROM professor WHERE pId = ?) WHERE profId = ?;";

		$statement = $pdo->prepare($sql);
		$statement->bindValue(1, $_GET['pId']);
		$statement->bindValue(2, $_SESSION['sId']);
		$statement->bindValue(3, $_GET['rate']);
		$statement->bindValue(4, $_GET['comment']);
		$statement->bindValue(5, $_GET['pId']);
		$statement->bindValue(6, $_GET['pId']);
		$statement->bindValue(7, $_GET['pId']);
		$statement->bindValue(8, $_GET['pId']);
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Error:", $e;
		}
		if($statement->rowCount() == 0){
			echo "Rating could not be added!";
		}
	}


	if (count($results) != 0){

		echo '<br><br><br><br><br><form method="GET">
			<label>Leave a Rating for a Professor:</label>
			<select name="pId">';
			
			foreach($results as $row){
				echo '<option value="' . $row['pId']. '">' . $row['name'] . "</option>\n";
			} 
			
	echo '	</select>
		<label>Rating:</label><input type="text" name = rate>
		<label>Comment:</label><input type="text" name = comment>
		<input type="submit" value="Submit!">
	</form></div></div>';
	}
?>

</center>
</body>
</html>