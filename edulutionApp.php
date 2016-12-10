<html>
<head>
	<style>
		section {
			color: white;
			text-align: center;
			margin: auto;
			margin-top: 25%;
			margin-left: 25%;
			margin-right: 25%;
			padding: 20px 20px;
			background-color: #4ABDAC;
			font-family: "Trebuchet MS", Helvetica, sans-serif;
		} 

		#submit {
			background-color: #F7B733;
			border: none;
			border-radius: 20px;
			color: white;
			padding: 5px 20px;
			margin-top: 5px;
			margin-left: 20%;
		}

	</style>
</head>
<body>
	<section>
		<form method='GET' action='generatePersonalPlaylists.php'>
			Firstname: <input type='text' name='firstname' value=Brian><br>
			Lastname: <input type='text' name='lastname' value=Chikosa><br>
			<input id="submit" type='submit' value='submit'>
		</form>
	</section>
</body>
</html>