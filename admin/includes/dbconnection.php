<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "msmsdb";

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
<?php
$con=mysqli_connect("localhost", "root", "", "msmsdb");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

  ?>
