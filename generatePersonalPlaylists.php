<?php
	//Database definitions
	$username = "root";
	$password = "";
	//Connects to database at the same location as this script
	mysql_connect('127.0.0.1', $username, $password);

	function retrieveUserID($firstname, $lastname) {
		try {
			$handle = new PDO('mysql:host=127.0.0.1; dbname=edulution',
                          'Users', '');//TODO DATABASE GOES HERE);
		} catch (PDOException $e) {
			die("Error connecting to database: ". $e->getMessage());
		}
		$sql = "SELECT userid FROM Users WHERE firstname = :n, lastname = :m;";
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

	function isStruggling($userid) {
		try {
			$handle = new PDO('mysql:host=127.0.0.1; dbname=edulution',
                          'Exercise_log', '');//TODO DATABASE GOES HERE);
		} catch (PDOException $e) {
			die("Error connecting to database: ". $e->getMessage());
		}
		$sql = "SELECT exercise_id FROM Exercise_log WHERE user_id = :n;";
		$query = $handle->prepare($sql);
		$query->execute(['n' => userid]);

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

?>