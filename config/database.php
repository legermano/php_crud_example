<?php
//Used to connect to the database
$host = "localhost";
$db_name = "php_beginner_crud_level_1";
$username = "root";
$password = "";

try {
  $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}

// Show error
catch(PDOException $exception){
  echo "Connection error: " . $exception->getMessage();
}