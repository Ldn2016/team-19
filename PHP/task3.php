<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Task 3</title>
</head>
<body>
<h1> Scores </h1>
<ul>
  <li><a href="menu.php">Menu</a></li>
  <li><a href="task1.php">Task 1</a></li>
  <li><a href="task2.php">Task 2</a></li>
  <li><a href="task3.php">Task 3</a></li>
</ul>

<h2> Select Team to View Scores </h2>
<?php
	session_start();
	
	if (!isset($_SESSION['loggedin']) ) {
		header("Location: loginform.html");
	}
$servername = "dragon.kent.ac.uk";
$username = "co323";
$password = "ausa#te";

try {
    $conn = new PDO("mysql:host=$servername;dbname=co323", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT tid, category, division, club.name, club.venue FROM team JOIN club ON team.clubID = club.cid ORDER BY club.name"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->fetchAll(); 
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

?>

<form action="task4.php" method="get">
Select Team:
<select name="team">

<?php foreach($result as $row) { ?>
	<option value="<?php echo $row['tid'] ?>"><?php echo $row ['name'] , ', ' , $row ['division'] , ', ' , $row ['category'] , ', ' , $row ['venue'];?> </option>
<?php } ?>	

</select>
<input type="submit" value="select">
</form>
<footer> 
 <p>You are logged in. Click <a href='logout.php'>here</a> to log out.</p>
</footer>

</body>
</html>
