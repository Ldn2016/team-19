<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<h1> Badminton </h1>
</head>
<?php
	session_start();
	session_destroy();
	echo("Do you want to <a href='loginform.html'>login</a>?");
?>
</html>