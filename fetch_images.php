<?php
include('includes/dbconnection.php');

// Check if category is set and not empty
if (isset($_POST['category']) && !empty($_POST['category'])) {
    // Sanitize input to prevent SQL injection
    $category = mysqli_real_escape_string($con, $_POST['category']);
    // Construct the query to fetch images by category
    $query = "SELECT * FROM tblgallery WHERE ImageCategory = '$category'";
} else {
    // If category is not provided or set to 'all', fetch all images
    $query = "SELECT * FROM tblgallery";
}

$result = mysqli_query($con, $query);

if (!$result) {
    // Error handling if the query fails
    echo '<p>Error retrieving images from database.</p>';
} else {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Output HTML for each image
            echo '<div class="gallery-item-wrapper mb-3 ' . $row['ImageCategory'] . '">';
            echo '<div class="gallery-item wow fadeIn">';
            echo '<a href="' . $row['ImagePath'] . '" class="venobox" data-gall="gallery" data-title="' . $row['ImageName'] . '">';
            echo '<img src="' . $row['ImagePath'] . '" class="img-fluid" alt="' . $row['ImageName'] . '">';
            echo '<div class="gallery-caption">';
            echo '<i class="fa fa-heart-o"></i>';
            echo '<h3>Bella Chica</h3>';
            echo '</div></a></div></div>';
        }
    } else {
        echo '<p>No images found.</p>';
    }
}

// Close database connection
mysqli_close($con);
?>
