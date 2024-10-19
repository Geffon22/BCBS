<?php
session_start();
include('includes/dbconnection.php');

if (isset($_POST['id'])) {  // Check if 'id' is set in the POST data
    $imageId = intval($_POST['id']);  // Ensure the ID is an integer

    // Prepare statement to get image path from database
    $stmt = $con->prepare("SELECT ImagePath FROM tblgallery WHERE ID = ?");
    if ($stmt) {
        $stmt->bind_param("i", $imageId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            $imagePath = $row['ImagePath'];

            // Delete image from server
            if (file_exists($imagePath) && unlink($imagePath)) {
                // Prepare statement to delete image record from database
                $stmt = $con->prepare("DELETE FROM tblgallery WHERE ID = ?");
                if ($stmt) {
                    $stmt->bind_param("i", $imageId);
                    if ($stmt->execute()) {
                        echo 'success';
                    } else {
                        echo 'error';
                    }
                } else {
                    echo 'error';
                }
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }

        $stmt->close();
    } else {
        echo 'error';
    }

    mysqli_close($con);
} else {
    echo 'error';
}
?>
