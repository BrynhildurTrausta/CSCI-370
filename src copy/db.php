<?php

	require '/var/www/vendor/autoload.php';
	
	$connection = new MongoDB\Client("mongodb://root:mongopwd@mongo:27017");
	
	$db = $connection->rateprofessor;

?>