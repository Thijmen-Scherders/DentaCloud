<?php
$servername = "localhost";
$database = "dentacloud";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

$conn->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



?>