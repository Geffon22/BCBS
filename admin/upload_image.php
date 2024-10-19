<?php
session_start();
include('includes/dbconnection.php');

// Handle image upload
if (isset($_POST['submit'])) {
    handleImageUpload($con);
}

function handleImageUpload($con) {
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "uploads/" . basename($image_name);
    
    // File validation
    $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    
    // Check if the file is actually an image
    $check = getimagesize($image_tmp);
    if($check === false) {
        echo 'error';
        return;
    }
    
    // Check file size (5MB maximum)
    if ($_FILES["image"]["size"] > 5000000) {
        echo 'error';
        return;
    }

    if (!in_array($imageFileType, $allowed_extensions)) {
        echo 'error';
        return;
    }

    // Create uploads directory if it doesn't exist
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if (move_uploaded_file($image_tmp, $image_path)) {
        // Using prepared statement to insert data
        $stmt = $con->prepare("INSERT INTO tblgallery (ImageName, ImagePath) VALUES (?, ?)");
        $stmt->bind_param("ss", $image_name, $image_path);
        
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }

        $stmt->close();
    } else {
        echo 'error';
    }

    // Close database connection
    $con->close();
}
?>
