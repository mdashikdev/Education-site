<?php
$servername = "localhost";
$username = "ashik";
$password = "12345Ashik";
$db="education_site";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

if (!$conn) {
	echo "connection Failed";
}

?>