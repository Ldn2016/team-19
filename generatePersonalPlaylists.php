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
		$sql = "SELECT * FROM Users WHERE firstname = :n, lastname = :m;";
		$query = $handle->prepare($sql);
		$query->execute(['n' => $firstname, 'm' => $lastname]);

		//query fails
		if ($query->execute() === FALSE) {
			die('Error running query: '.implode($query->errorInfo(), ' '));
		}
		//puts result into assoc array
		$results = $query->fetchAll();

		//TODO -------- what to do if results are empty? die() at the end
		foreach ($results as $row) {
      echo $row['user_id'];
      echo "test";
   		}   
   		if(count($results) == 0)
   {
		echo "<br>";
		echo "There are no results for this team";
		die();
   }
		//echo $results;
		return $results;
	}

	//Returns a list of exerciseid that the given userid is struggling with
	function isStruggling($userid) {
		try {
			$handle = new PDO('mysql:host=127.0.0.1; dbname=edulution',
                          'root', '');//TODO DATABASE GOES HERE);
		} catch (PDOException $e) {
			die("Error connecting to database: ". $e->getMessage());
		}
		$sql = "SELECT exercise_id FROM Exercise_log WHERE user_id = :n;";
		$query = $handle->prepare($sql);
		$query->execute(['n' => $userid]);

		//query fails
		if ($query->execute() === FALSE) {
			die('Error running query: '.implode($query->errorInfo(), ' '));
		}
		//puts result into assoc array
		$results = $query->fetchAll();

		//TODO -------- what to do if results are empty? die() at the end
		return $results;
		//Will be a list of exercise_id that the student is flagged as struggling with
	}

	//errr....
	function suggestExercise($exerciseid) {
		try {
			$handle = new PDO('mysql:host=127.0.0.1; dbname=edulution',
                          'Exercise_log', '');//TODO DATABASE GOES HERE);
		} catch (PDOException $e) {
			die("Error connecting to database: ". $e->getMessage());
		}
		//run through the list, run sql queries for all the exerciseid in the list, getting their paths
		//for ($i = 0; i < exerciseid.num_rows() - 1; i++) {
		//	$sql = "SELECT exercise_id, item_path FROM Items WHERE exercise_id = "
		//}
		//put all the paths in an array, then choose a random one?
		//take the path, get a new exercise id, then return the exercise id
	}

	$user = retrieveUserID(null, null);
	isStruggling($user);

?>