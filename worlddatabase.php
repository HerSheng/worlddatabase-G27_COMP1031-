<?php
// used to connect to the database
$servername = "localhost";
$db_name = "world";
$username = "root";
$password = "";
  
try {
    $con = new PDO("mysql:host={$servername};dbname={$db_name}", $username, $password);
}
  
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
?>