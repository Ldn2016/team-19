<?php
	//Database definitions
$username = "root";
$password = "";
	//Connects to database at the same location as this script
mysql_connect('127.0.0.1', $username, $password);

	//Returns the userid of the user with the given first+lastname combination
function retrieveUserID($firstname, $lastname) {
	try {
		$handle = new PDO('mysql:host=127.0.0.1; dbname=edulution',
                          'root', '');//TODO DATABASE GOES HERE);
	} catch (PDOException $e) {
		die("Error connecting to database: ". $e->getMessage());
	}
		//$sql = "SELECT * FROM Users WHERE user_id = '00855a2465774deda66c0417e16c4a';";
	$sql = "SELECT * FROM Users WHERE first_name = $firstname AND last_name = $lastname";
	$query = $handle->prepare($sql);
	$query->execute();
		//$query->execute(['n' => $firstname, 'm' => $lastname]);
		//query fails
	if ($query->execute() === FALSE) {
		die('Error running query: '.implode($query->errorInfo(), ' '));
	}
		//puts result into assoc array
	$results = $query->fetchAll();

		//TODO -------- what to do if results are empty? die() at the end
	foreach ($results as $row) {
		return $row['user_id'];
	}   
	if(count($results) == 0)
	{
		echo "<br>";
		echo "There are no results";
		die();
	}
		//echo $results;
}

	//Returns a list of exerciseid that the given userid is struggling with
function isStruggling($userid) {
	try {
		$handle = new PDO('mysql:host=127.0.0.1; dbname=edulution',
                          'root', '');//TODO DATABASE GOES HERE);
	} catch (PDOException $e) {
		die("Error connecting to database: ". $e->getMessage());
	}
	$newuserid = "'" . $userid . "'";
	$sql = "SELECT exercise_id FROM exercise_log WHERE user_id = $newuserid AND struggling = 1";

	$query = $handle->prepare($sql);
	$query->execute();

		//query fails
	if ($query->execute() === FALSE) {
		die('Error running query: '.implode($query->errorInfo(), ' '));
	}
		//puts result into assoc array
	$results = $query->fetchAll();

	foreach ($results as $row) {
      		//return $row['user_id'];
		$huy = $row['exercise_id'];
		getSequence($huy);
		//suggestExercise($huy);
		echo "<br>";
	}   
	if(count($results) == 0)
	{
		echo "<br>";
		echo "There are no results";
		die();
	}

		//TODO -------- what to do if results are empty? die() at the end
	return $results;
		//Will be a list of exercise_id that the student is flagged as struggling with
}

//returns the sequence of the exercise in the playlist
function getSequence($exerciseid) {
	//exerciseid is an array?
	try {
		$handle = new PDO('mysql:host=127.0.0.1; dbname=edulution',
                          'root', '');//TODO DATABASE GOES HERE);
	} catch (PDOException $e) {
		die("Error connecting to database: ". $e->getMessage());
	}
	$exercise = '"' . $exerciseid . '"';
	$sql = "SELECT sequence, exercise_id FROM playlist WHERE exercise_id = $exercise";
	//echo $sql;
	$query = $handle->prepare($sql);
	$query->execute();

		//query fails
	if ($query->execute() === FALSE) {
		die('Error running query: '.implode($query->errorInfo(), ' '));
	}
		//puts result into assoc array
	$results = $query->fetchAll();
	foreach ($results as $row) {
      		//return $row['user_id'];
		$number = $row['sequence'];
		$exid = $row['exercise_id'];
		suggestExercise($number, $exid);
		echo "<br>";
	} 
		//just get the sequence from the assoc array
}

	//suggests what exercise to do
function suggestExercise($exerciseid, $sequence) {
	// exercseid
	try {
		$handle = new PDO('mysql:host=127.0.0.1; dbname=edulution',
                          'root', '');//TODO DATABASE GOES HERE);
	} catch (PDOException $e) {
		die("Error connecting to database: ". $e->getMessage());
	}
	$sql = "SELECT title, path FROM playlist WHERE exercise_id = '$sequence' AND sequence = $exerciseid";
	//echo $sql;
	$query = $handle->prepare($sql);
	$query->execute();
		//puts result into assoc array
	$results = $query->fetchAll();

	foreach($results as $row) {
		echo $row['title'];
		echo "<br>";
		echo $row['path'];
		echo "<br>";
	}
}

$user = retrieveUserID("'Brian'", "'Chikosa'");
$struggling = isStruggling($user);

//for($i = 0; $i < count($struggling); $i++) {
//	$sequence = getSequence($struggling[$i]);

//}

?>