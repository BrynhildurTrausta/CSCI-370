

<ul>
	<li><a href="index.php" class="active">Home</a></li>
	<li><?php
	if(isset($_SESSION['email'])){
		echo '<a href="login.php?logout=t">Logout</a>';
		echo $_SESSION['email'];
	}else{
		echo '<a href="login.php">Login</a>';
	}

	?></li>	
</ul>