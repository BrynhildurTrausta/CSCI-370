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
<center>
<?php include("menu.php"); ?>
<hr>

<?php
// Department column on page
	$sql = "SELECT * FROM professor;";

	$statement = $pdo->prepare($sql);
	try{
		$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}

	echo '<div style="display: flex; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">';
	echo '<div style="border-radius: 20px; margin-left: 10px; height: 450px; border: 1px solid #fff; width: 460px; transition: .3s all ease;">';

	echo '<h2 style="color: black;">Departments</h2>';

	echo "<table class=\"styled-table\" style=\"width: 400px\" border=\"1\">\n";
		echo '<tr>';
		echo '<th>Department</th>';
		echo '<th>Number of Ratings</th>';
		echo '<th>Average Rating</th>';
		echo '</tr>';
	while($row = $statement->fetch(PDO::FETCH_ASSOC)){
		echo '<tr>';
		echo '<td>',$row['department'],"</td>\n";
		echo '<td>',$row['nbr'],"</td>\n";
		echo '<td>',$row['avg'],"</td>\n";
		echo '</tr>';
		//var_dump($row);
	}
	echo '</table></div>';

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

	echo '<div style="border-radius: 20px; margin-left: 10px; height: 450px; border: 1px solid #fff; width: 460px; transition: .3s all ease;">';

	echo '<h2 style="color: black;">Professors</h2>';

	echo "<table class=\"styled-table\" style=\"width: 400px\" border=\"1\">\n";
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
	echo '</table></div>';

?>


<?php

// The Search for column on the page
	$sql = "SELECT * FROM professor;";

	$statement = $pdo->prepare($sql);
	try{
		$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}
	$results = $statement->fetchAll();


	echo '<div style="border-radius: 20px; margin-left: 10px; height: 450px; border: 1px solid #fff; width: 460px; transition: .3s all ease;">';

	echo '<h2 style="color: black;">Search for Professors Ratings:</h2>';

if (count($results) != 0){

		echo '<form method="GET">
			<label>Choose a Professor:</label>
			<select name="pId">';
			
			foreach($results as $row){
				echo '<option value="' . $row['pId']. '">' . $row['name'] . "</option>\n";
			}
			
	echo '	</select>
		<input type="submit" value="Search!">
	</form>';
	}

	if(isset($_GET['pId'])){
		$sql = "SELECT * FROM professor, rating WHERE professor.pId = ? AND rating.profId = ?;";
		$statement = $pdo->prepare($sql);
		$statement->bindValue(1, $_GET['pId']);
		$statement->bindValue(2, $_GET['pId']);
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Error:", $e;
		}	
		if($statement->rowCount() == 0){
			echo "no ratings were found!";
		}
		echo "<table class=\"styled-table\" style=\"width: 440px\" border=\"1\">\n";
			echo '<tr>';
			echo '<th>Name</th>';
			echo '<th>Department</th>';
			echo '<th>Rate</th>';
			echo '<th>Comment</th>';
			echo '</tr>';
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			echo '<tr>';
			echo '<td>',$row['name'],"</td>\n";
			echo '<td>',$row['department'],"</td>\n";
			echo '<td>',$row['rate'],"</td>\n";
			echo '<td>',$row['comment'],"</td>\n";
			echo '</tr>';
			//var_dump($row);
		}
		echo '</table></div></div>';
	} else {
		echo "<table class=\"styled-table\" style=\"width: 440px\" border=\"1\">\n";
			echo '<tr>';
			echo '<th>Name</th>';
			echo '<th>Department</th>';
			echo '<th>Rate</th>';
			echo '<th>Comment</th>';
			echo '</tr>';
		echo '</table></div></div>';
	}

	echo '<div style="display: flex; position: absolute; top: 92%; left: 50%; transform: translate(-50%, -50%);">';
	echo '<div style="border-radius: 20px; margin-left: 10px; height: 50px; width: 1000px; transition: .3s all ease;">';

// The Add a rating column on the page 

	if(isset($_GET['pId']) && isset($_GET['rate']) && isset($_GET['comment'])){
		$sql = "INSERT INTO rating (profId, rate, comment) VALUES (?, ?, ?);
				UPDATE professor SET avgP = (SELECT AVG(rate) FROM rating WHERE profId = ?)WHERE pId = ?;";

		$statement = $pdo->prepare($sql);
		$statement->bindValue(1, $_GET['pId']);
		$statement->bindValue(2, $_GET['rate']);
		$statement->bindValue(3, $_GET['comment']);
		$statement->bindValue(4, $_GET['pId']);
		$statement->bindValue(5, $_GET['pId']);
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Error:", $e;
		}
		if($statement->rowCount() == 0){
			echo "no rows from the movie table were deleted!";
		}
	}


	if (count($results) != 0){

		echo '<form method="GET">
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