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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Debugging: Check what values are being received
    echo "Username: " . $username . "<br>";
    echo "Password: " . $password . "<br>";

    // Prepare SQL statement using prepared statements
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Store result
    $result = $stmt->get_result();

    // Check if user exists in database and verify password
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Debugging: Check the hashed password in the database
        echo "Hashed Password from DB: " . $user['password'] . "<br>";

        if (password_verify($password, $user['password'])) {
            // Password is correct, login successful
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            $_SESSION['login_error'] = "Invalid username or password.";
            header("Location: index.php"); // Redirect back to login page
            exit();
        }
    } else {
        // Username not found
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: index.php"); // Redirect back to login page
        exit();
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
