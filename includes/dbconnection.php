
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "msmsdb";

// Create connection
$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

// Return the connection object
return $con;
?>

