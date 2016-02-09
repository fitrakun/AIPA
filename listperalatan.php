<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duktek";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql="SELECT * FROM `alat`";
$result = $conn->query($sql);

?>