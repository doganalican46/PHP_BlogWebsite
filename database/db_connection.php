<?php
$hostname = "localhost";
$username = "root"; 
$password = ""; 
$database = "blogwebsite"; 

$connection = new mysqli($hostname, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


    // echo "Connected successfully to the database.";

?>
