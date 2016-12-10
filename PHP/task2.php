<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title> Task 2 </title>
</head>
<body>
<h1> Number of Teams for Each Club </h1>
<ul>
  <li><a href="menu.php">Menu</a></li>
  <li><a href="task1.php">Task 1</a></li>
  <li><a href="task2.php">Task 2</a></li>
  <li><a href="task3.php">Task 3</a></li>
</ul>

<?php
	session_start();
	
	if (!isset($_SESSION['loggedin']) ) {
		header("Location: loginform.html");
	}
echo '<table style="margin: 0 auto;">';
echo "<tr><th>Club</th><th> Number Of Teams</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "dragon.kent.ac.uk";
$username = "co323";
$password = "ausa#te";

try {
    $conn = new PDO("mysql:host=$servername;dbname=co323", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM(select name, count(*) teams from club join team on club.cid = team.clubID group by name) AS clubs where teams > 2"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {         
		echo $v;
	}
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
<footer> 
 <p>You are logged in. Click <a href='logout.php'>here</a> to log out.</p>
</footer>
</body>
</html>

