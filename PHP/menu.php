<?php 
	session_start();
	
	if (!isset($_SESSION['loggedin']) ) {
		header("Location: loginform.html");
	}
	
	?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="menu.css">
<title> Menu </title>
</head>
<body>
<h1 class="center"> Menu </h1>

<div>
<table style="margin: 0 auto;">
<tr>
<th colspan=3> Menu </th>
</tr>
<tr>
<td><a href="task1.php">Task 1</a></td>
<td><a href="task2.php">Task 2</a></td>
<td><a href="task3.php">Task 3</a></td>
</tr>
</table>
<footer> 
 <p>You are logged in. Click <a href='logout.php'>here</a> to log out.</p>
</footer>
</div>
</body>
</html>
