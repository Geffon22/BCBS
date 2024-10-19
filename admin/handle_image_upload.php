<?php
session_start();
include('includes/dbconnection.php');

handleImageUpload($con);

function handleImageUpload($con) {
    if(isset($_FILES['image'])){
        $image_count = count($_FILES['image']['name']);
        $upload_success = true; // Flag to track overall upload success

        // Loop through each uploaded file
        for ($i = 0; $i < $image_count; $i++) {
            $image_name = $_FILES['image']['name'][$i];
            $image_tmp = $_FILES['image']['tmp_name'][$i];
            $image_path = "uploads/" . basename($image_name);

            // File validation
            $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
            $allowed_extensions = array("jpg", "jpeg", "png", "gif");

            // Check if the file is actually an image
            $check = getimagesize($image_tmp);
            if($check === false) {
                echo 'error_invalid_file';
                $upload_success = false;
                continue; // Skip this file and move to the next one
            }

            // Check file size (5MB maximum)
            if ($_FILES["image"]["size"][$i] > 5000000) {
                echo 'error_file_size';
                $upload_success = false;
                continue; // Skip this file and move to the next one
            }

            if (!in_array($imageFileType, $allowed_extensions)) {
                echo 'error_invalid_extension';
                $upload_success = false;
                continue; // Skip this file and move to the next one
            }

            // Create uploads directory if it doesn't exist
            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            if (!move_uploaded_file($image_tmp, $image_path)) {
                echo 'error_upload';
                $upload_success = false;
                continue; // Skip this file and move to the next one
            }

            // Using prepared statement to insert data
            $stmt = $con->prepare("INSERT INTO tblgallery (ImageName, ImagePath) VALUES (?, ?)");
            $stmt->bind_param("ss", $image_name, $image_path);
            
            if (!$stmt->execute()) {
                echo 'error_database';
                $upload_success = false;
            }

            $stmt->close();
        }

        if ($upload_success) {
            echo 'success';
        }
    } else {
        echo 'error_no_file';
    }

    // Close database connection
    $con->close();
}
?>
