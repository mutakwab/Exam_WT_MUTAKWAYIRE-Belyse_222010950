<?php
// Connection details
$host = "localhost";
$user = "222010950";
$pass = "belysee";
$database = "online_web_development_courses_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>

