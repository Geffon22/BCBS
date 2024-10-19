<?php
include('includes/dbconnection.php');

// Function to fetch images from the database
function fetchImages($con) {
    $ret = mysqli_query($con, "SELECT * FROM tblgallery");
    return mysqli_fetch_all($ret, MYSQLI_ASSOC);
}
?>
