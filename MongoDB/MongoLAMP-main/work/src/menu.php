<ul>
	<li><?php
		if(isset($_SESSION['email']) && strpos($_SESSION['email'], '.edu') !== false){  // Tripple equal tests the type and the value
			echo '<a href="admin.php"> Add Classes </a>';
			echo '<a href="deleteAdmin.php"> Delete Reviews </a>';
		}
		if(isset($_SESSION['email'])){
			echo '<a href="home.php" class="active">Home</a>';
			echo '<a href="addReview.php">Add a Review</a>';
			echo '<a href="login.php?logout=t">Logout </a>';
			echo $_SESSION['email'];
		}else{
			echo '<a href="index.php" class="active">Front Page</a>';
			echo '<a href="login.php">Login</a>';
		}


	?></li>
</ul>
