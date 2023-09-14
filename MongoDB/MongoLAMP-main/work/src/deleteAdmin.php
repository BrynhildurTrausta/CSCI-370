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
		<title>Delete Reviews</title>
		<link href="style.css" rel="stylesheet" type="text/css"/>
	</head>

	<body>

		<?php include("menu.php"); ?>


		<?php
			echo '<center>';

			// Printing out all reviews

			echo '<h1>All Reviews:</h1>';

			$col = $db->review;
			$result = $col->find();
			echo '<table>';
				echo "<tr>
					<th>Class</th>
					<th>Professor</th>
					<th>Rating</th>
					<th>Review</th>
					<th>Email address</th>
				</tr>\n";
				foreach($result as $review){
					echo "<tr>";
						echo "<td>" . $review["class"] . '</td>';
						echo "<td>" . $review["prof"] . '</td>';
						echo "<td>" . $review["rating"] . '</td>';
						echo "<td>" . $review["review"] . '</td>';
						echo "<td>" . $review["student"] . '</td>';
					echo '</tr>';
				}
			echo '</table><br>';

			// Deleting a review

			echo '<form method="GET" >';
				echo '<label><h2>Select a review to delete:  </h2></label>';
				echo '<select name="del_review"><br>';
					$col = $db->review;
					$options = ['sort' => ['_id' => 1]];
					$result = $col->find([],$options);
					foreach($result as $r){
						echo '<option value="' . $r['_id'] . '">' . $r['student'] . ' and ' . $r['class'] . '</option><br>';
					}
					echo '</select>';
				echo '<input type="submit" value="Delete a review!">';
			echo '</form>';

			echo '</center>';
		?>

	</body>
</html>