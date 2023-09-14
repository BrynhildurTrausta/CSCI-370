<?php
	session_start();
	include('db.php');

	if(isset($_GET['del_review'])){
		$col = $db->review;
		$doc = ["_id" => $_GET['del_review']];	

		try{
			$result = $col->deleteOne($doc);
		} catch(Exception $e){
			$error .= "Something went wrong.";
		}
	}
?>
<html>
	<head>
		<title>Mongo RateYourProfessor</title>
		<link href="style.css" rel="stylesheet" type="text/css"/>
	</head>

	<body>

		<?php include("menu.php"); ?>

		<div class="div-outer">

			<div class="div-inner"><center>
			<h1>Reviews for a class</h1>
			<form method="GET" >
				<label>Class:</label><select name="class_name"><br>
				<?php
					$col = $db->class;
					$options = ['sort' => ['_id' => 1]];
					$result = $col->find([],$options);
					foreach($result as $p){
						echo '<option value="' . $p['_id'] . '">' . $p['_id'] . "</option>\n";
					}
				?>
				</select>
				<input type="submit" value="Get Reviews!">
			</form>
				<?php
					if(isset($_GET['class_name'])){
						$col = $db->review;
						$doc = [
						"class" => $_GET['class_name']
						];	
						$options = ['sort' => ['_id' => -1]];
						$result = $col->find($doc, $options);
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
								echo "<td>" . $r["prof"] . '</td>';
								echo "<td>" . $r["rating"] . '</td>';
								$rating_sum += $r["rating"]; 
								echo "<td>" . $r["review"] . '</td>';
								echo '</tr>';
							}
						echo '</table>';
						echo 'Average Rating: ' . $rating_sum / count($rarray) . '<br><br><br>';
						}
					}else{
							echo "No class specified.<br><br>";
					}

				?>

				<form method="GET" >
					<label>Text search</label>
					<input type="text" name="text_search">
					<input type="submit" value="Search Reviews!">
				</form>
				<?php
					if(isset($_GET['text_search'])){
						$col = $db->review;
						$doc = [
						'$text' => ['$search' => $_GET['text_search']]
						];	
						$options = ['sort' => ['_id' => -1]];
						$result = $col->find($doc, $options);
						echo 'Searching for: ' . $_GET['text_search'] . "<br>";
						$rarray = $result->toArray();
						if(count($rarray) == 0){
							echo "No reviews found.<br><br>";
						}else{
							echo '<table border="1">';
							echo "<tr><th>Professor</th><th>Rating</th><th>Review</th></tr>\n";
							foreach($rarray as $r){
							echo "<tr>";
							echo "<td>" . $r["prof"] . '</td>';
							echo "<td>" . $r["rating"] . '</td>';
							echo "<td>" . $r["review"] . '</td>';
							echo '</tr>';
						}
						echo '</table><br><br>';
						}
					}else{
						echo "No class specified.<br><br>";
					}

				?>


				<form method="GET" >
					<label>Regex search</label>
					<input type="text" name="regex_search">
					<input type="submit" value="Search Reviews!">
				</form>
				<?php
					if(isset($_GET['regex_search'])){
						$col = $db->review;
						$doc = [
						'review' => [ '$regex' => $_GET['regex_search']],
						];	
						$options = ['sort' => ['_id' => -1]];
						$result = $col->find($doc, $options);
						echo 'Searching for: ' . $_GET['regex_search'] . "<br>";
						$rarray = $result->toArray();
						if(count($rarray) == 0){
							echo "No reviews found.<br>";
						}else{
							echo '<table border="1">';
							echo "<tr><th>Professor</th><th>Rating</th><th>Review</th></tr>\n";
							foreach($rarray as $r){
							echo "<tr>";
							echo "<td>" . $r["prof"] . '</td>';
							echo "<td>" . $r["rating"] . '</td>';
							echo "<td>" . $r["review"] . '</td>';
							echo '</tr>';
						}
						echo '</table><br><br>';
						}
					}else{
						echo "No class specified.<br><br>";
					}

				?>

			</center></div>

			<div class="div-inner"><center>

				<h1>Your Reviews:</h1>

				<?php
					$col = $db->review;
					$doc = ['student' => $_SESSION['email']];
					$options = ['sort' => ['student' => -1]];
					$result = $col->find($doc, []);
					echo '<table>';
					echo "<tr>
					<th>Class</th>
					<th>Professor</th>
					<th>Rating</th>
					<th>Review</th>
					</tr>\n";
					foreach($result as $review){
						echo "<tr>";
						echo "<td>" . $review["class"] . '</td>';
						echo "<td>" . $review["prof"] . '</td>';
						echo "<td>" . $review["rating"] . '</td>';
						echo "<td>" . $review["review"] . '</td>';
						echo '</tr>';
					}
					echo '</table><br>';

					// Deleting own reviews

					echo '<form method="GET" >';
					echo '<label><h2>Select a review to delete:  </h2></label><select name="del_review"><br>';
					$col = $db->review;
					$doc = ['student' => $_SESSION['email']];
					$options = ['sort' => ['_id' => 1]];
					$result = $col->find($doc, $options);
					foreach($result as $r){
						echo '<option value="' . $r['_id'] . '">' . $r['class'] . ' with ' . $r['prof'] . '</option><br>';
					}
					echo '</select>';
					echo '<input type="submit" value="Delete a review!">';
					echo '</form>';
				?>

			</center></div>
		</div>

	</body>
</html>