<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title> Login </title>
<h1> Login </h1>
</head>
<body>

<?php 
session_start();

$secret_username = "t5";
$secret_password = "just4fun";

if ($_POST['username'] == $secret_username &&
		$_POST['password'] == $secret_password){
		$_SESSION["loggedin"] = TRUE;
		
		header( 'Location: menu.php' ) ;
	}
else {
	echo "Please enter correct details <br>";
	echo "To login again, click <a href='loginform.html'>Here</a>";
	return;
}

?>

<body>
</html>