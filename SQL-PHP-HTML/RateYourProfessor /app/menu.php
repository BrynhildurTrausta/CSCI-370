		<ul>
			<li><?php
				if(isset($_SESSION['email'])){
					echo '<a href="index.php" class="active">Home</a>';
					echo '<a href="Rating.php">Ratings</a>';
					echo '<a href="search.php">Search</a>';
					echo '<a href="login.php?logout=t">Logout </a>';
					echo $_SESSION['email'];
				}else{
					echo '<a href="index.php" class="active">Home</a>';
					echo '<a href="login.php">Login</a>';
				}

			?></li>
		</ul>
