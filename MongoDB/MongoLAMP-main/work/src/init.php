<?php

	include('db.php');

	$col = $db->class;
	$doc = [["_id"=>"CSCI 470 - Databases"],
			["_id"=>"CSCI 101 - Keyboarding"],
			["_id"=>"HIST 230 - World Wars"],
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

	$col = $db->review;
	$doc = [["_id" => "HIST 230 - World WarsDr. Strangeuser1@uindy.edu",
     "review" => "He used a time stone to show us cool stuff.",
     "class" => "HIST 230 - World Wars",
     "prof" => "Dr. Strange",
     "rating" => "5",
     "student" => "user1@uindy.edu"],
     ["_id" => "CSCI 101 - KeyboardingDr. Answersuser1@uindy.edu",
     "review" => "He didn't have the answers.",
     "class" => "CSCI 101 - Keyboarding",
     "prof" => "Dr. Answers",
     "rating" => "2",
     "student" => "user1@uindy.edu"],
     ["_id" => "CSCI 470 - DatabasesDr. Pepperuser1@uindy.edu",
     "review" => "Too much sugar.",
     "class" => "CSCI 470 - Databases",
     "prof" => "Dr. Pepper",
     "rating" => "1",
     "student" => "user1@uindy.edu"],
     ["_id" => "CSCI 470 - DatabasesDr. Bobuser1@uindy.edu",
     "review" => "Has a son called Little Bobby Tables.",
     "class" => "CSCI 470 - Databases",
     "prof" => "Dr. Bob",
     "rating" => "3",
     "student" => "user1@uindy.edu"],
     ["_id" => "CSCI 101 - KeyboardingMr.Pibuser1@uindy.edu",
     "review" => "Spilled soda-pop all over the keyboard.",
     "class" => "CSCI 101 - Keyboarding",
     "prof" => "Mr.Pib",
     "rating" => "1",
     "student" => "user1@uindy.edu"],
     ["_id" => "CSCI 455 - Intro to ProgrammingDr. Answersuser1@uindy.edu",
     "review" => "He had all the answers.",
     "class" => "CSCI 455 - Intro to Programming",
     "prof" => "Dr. Answers",
     "rating" => "5",
     "student" => "user1@uindy.edu"]
];
	$col->insertMany($doc);
	$col->createIndex(['review' => "text"])

?>
	