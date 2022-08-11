<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="education_site";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

if (!$conn) {
	echo "connection Failed";
}

?>