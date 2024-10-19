<?php
session_start();
// Database connection parameters
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "msmsdb";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$showSuccessAlert = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        $showSuccessAlert = true;  // Trigger alert on success
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .alert-container {
            position: fixed;
            top: 0; /* Positioned at the top */
            left: 50%;
            transform: translateX(-50%); /* Horizontally centered */
            z-index: 9999;
            width: 100%; /* Full width */
            display: none; /* Initially hidden */
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <!-- Success Notification -->
    <div class="alert-container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Registration successful! Redirecting...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    <?php if ($showSuccessAlert): ?>
        // Show the alert
        var alertBox = document.querySelector('.alert-container');
        alertBox.style.display = 'block';

        // Hide after 5 seconds
        setTimeout(function() {
            alertBox.style.display = 'none';
            window.location.href = 'index.php'; // Redirect to login page after 5 seconds
        }, 3000);
    <?php endif; ?>
</script>

</body>
</html>
