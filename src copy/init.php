<?php

	include('db.php');

	$col = $db->class;
	$doc = [["_id"=>"CSCI 470 - Databases"],
			["_id"=>"CSCI 455 - Intro to Programming"]];
	$col->insertMany($doc);

	$col = $db->professor;
	$doc = [["_id"=>"Dr. Strange"],
			["_id"=>"Dr. Answers"],
			["_id"=>"Dr. Bob"],
			["_id"=>"Dr. Pepper"],
			["_id"=>"Mr.Pib"]];
	$col->insertMany($doc);

	$col = $db->user;
	$doc = [["_id"=>"user1@uindy.edu","password"=>"bob"],
			["_id"=>"user2@uindy.edu","password"=>"bob"]];
	$col->insertMany($doc);

?>
		
		