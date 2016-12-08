
<?php

//Connent to SJUS database
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'sjus';

		$conn = mysqli_connect($dbhost, $dbuser,$dbpass);
		mysqli_select_db ($conn,$dbname);
		
		if (!$conn) 
		{
			die("Connection failed: " . mysqli_connect_error());
		}

		
?>	