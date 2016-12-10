<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title> Task 4 </title>

</head>
<body>
<h1> Score </h1>
<ul>
  <li><a href="menu.php">Menu</a></li>
  <li><a href="task1.php">Task 1</a></li>
  <li><a href="task2.php">Task 2</a></li>
  <li><a href="task3.php">Task 3</a></li>
</ul>

<?php
   // Connect to database, and complain if it fails
   try {
      $dbhandle = new PDO('mysql:host=dragon.kent.ac.uk; dbname=co323',
                          'co323', 'ausa#te');
   } 
   catch (PDOException $e) {
      // The PDO constructor throws an exception if it fails
      die('Error Connecting to Database: ' . $e->getMessage());
   }
   $teamID = $_GET['team'];
   // Run the SQL query, and print error message if it fails.
   $sql = "SELECT * FROM fixture WHERE homeTeam = :n OR awayTeam = :n"; 
	
   $query = $dbhandle->prepare($sql);
   $query->execute(['n' => $teamID]);
   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
   
   //Checks to see if there is that the club teamID exists
   if(count($results) == 0)
   {
		echo "<br>";
		echo "There are no results for this team";
		die();
   }
	
   // Printing out the club names and addresses in the array results
?>
   <h2>Details</h2>
   <table>
      <tr>
         <th>Date</th><th>Home Team</th><th>Away Team</th><th>Home Team Score</th><th>Away Team Score</th>
      </tr>
	  
<?php		
   foreach ($results as $row) {
      echo "<tr><td>".$row['onDate']."</td><td>".$row['homeTeam']."</td><td>".$row['awayTeam']."</td><td>".$row['homeTeamScore']."</td><td>".$row['awayTeamScore'];
   }   
?>		
   </table>
<footer> 
 <p>You are logged in. Click <a href='logout.php'>here</a> to log out.</p>
</footer>

</body>
</html>

