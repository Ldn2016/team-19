<style>
	body {
		background-color: #4ABDAC;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		padding: 0% 10%;
		text-align: center;
	}

	ul {
		list-style-type: none;
		margin-left: 20%;
		margin-right: 20%;
		padding: 0;
		overflow: hidden;
		background-color: #333;
	}



	li a {
		display: block;
		color: white;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
	}

	/* Change the link color to #111 (black) on hover */
	li a:hover {
		background-color: #111;
	}

	footer {
		position:fixed;
		left:0px;
		bottom:0px;
		height:20px;
		width:100%;
		background:#999;
		padding-top: 10px;
		padding-bottom: 5px;
	}

	p, a {
		color: white;
		border: none;
	}
</style>

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
		echo "<p>You don't seem to be struggling with anything at the moment</p>";
		echo '<a href="#" onClick="alert' . "('Have a medal!')" . '"><img title="Congrats!" /></a>" ';
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
		//echo "<br>";
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

	//return $results;
	foreach($results as $row) {
		//echo "<li>".$row['title']." ";
		echo "<li> <a href = 'http://demo.learningequality.org/learn/" . $row['path'] . "'>" . $row['title'] . "</a></li>";
	}	
}

$first = "'". $_GET['firstname']."'";
$last = "'".$_GET['lastname']."'";
echo "<h1> Personalised Learning for " . $_GET['firstname'] . " " . $_GET['lastname'] . "</h1>";
echo "<hr>";
echo "<h3>Struggling problems:</h3>";
echo "<ul>";
$user = retrieveUserID($first, $last);
$struggling = isStruggling($user);
echo "</ul>";


//for($i = 0; $i < count($struggling); $i++) {
//	$sequence = getSequence($struggling[$i]);

//}

?>

<footer>
	Edulution demo
</footer>