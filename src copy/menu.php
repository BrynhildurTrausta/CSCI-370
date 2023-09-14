
<table width="100%">
	<tr>
<td><a href="index.php">Home</a> </td>

<td><a href="addReview.php">Add a Review</a></td>
<td><?php
	if(isset($_SESSION['email'])){
		echo '<a href="login.php?logout=t">Logout</a>';
		echo $_SESSION['email'];
	}else{
		echo '<a href="login.php">Login</a>';
	}

?></td>

<?php
	if(isset($_SESSION['email']) && strpos($_SESSION['email'], '.edu') !== false){
		echo '<td>';
		echo '<a href="classes.php">Admin</a>';
		echo '</td>';
	}
?>

</tr></table>

