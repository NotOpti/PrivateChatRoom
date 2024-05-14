<?php
// Database connection credentials
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "chatapp";

  // Establishing a connection to the database
  $conn = mysqli_connect($hostname, $username, $password, $dbname);

  // Checking if the connection was successful
  if(!$conn){
    echo "Database connection error".mysqli_connect_error(); // Output error message if connection fails
  }
?>
