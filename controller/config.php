<?php
	function connect_database() {
		$servername = "127.0.0.1";
		$username = "root";
		$password = "";
		$dbname = "AIPA";
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		
		return $conn;
	}
?>