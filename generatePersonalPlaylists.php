<?php
	//Database definitions
	$username = "";
	$password = "";
	//Connects to database at the same location as this script
	mysql_connect('127.0.0.1', $username, $password);

	//Returns the userid of the user with the given first+lastname combination
	function retrieveUserID(firstname, lastname) {
		try {
			$handle = new PDO(//TODO DATABASE GOES HERE);
		} catch (PDOException $e) {
			die("Error connecting to database: ". $e->getMessage());
		}
		$sql = "SELECT userid FROM Users WHERE firstname = :n, lastname = :n;";
		$query = $handle->prepare($sql);
		$query->execute(['n' => firstname, 'm' => lastname]);

		//query fails
		if ($query->execute() === FALSE) {
			die('Error running query: '.implode($query->errorInfo(), ' '));
		}
		//puts result into assoc array
		$results = $query->fetchAll();

		//TODO -------- what to do if results are empty? die() at the end
		return $results;
	}

	//Returns a list of exerciseid that the given userid is struggling with
	function isStruggling(userid) {
		try {
			$handle = new PDO(//TODO DATABASE GOES HERE);
		} catch (PDOException $e) {
			die("Error connecting to database: ". $e->getMessage());
		}
		$sql = "SELECT exercise_id FROM Exercise_log WHERE user_id = :n;";
		$query = $handle->prepare($sql);
		$query->execute(['n' => userid);

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
	function suggestExercise(exerciseid) {
		try {
			$handle = new PDO(//TODO DATABASE GOES HERE);
		} catch (PDOException $e) {
			die("Error connecting to database: ". $e->getMessage());
		}
		for ($i = 0; i < exerciseid.num_rows() - 1; i++) {
			$sql = "SELECT exercise_id, item_path FROM Items WHERE exercise_id = "
		}
	}

?>