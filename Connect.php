<?php
$servername = "localhost";
$database = "dentacloud";
$username = "localhost";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);


if ($conn->connect_error) 

{
die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

mysqli_close($conn);

?>