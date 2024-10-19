<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Set timezone to Philippines
date_default_timezone_set('Asia/Manila');

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    
    // Check if email exists in the database using prepared statement
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a unique password reset token
        $token = bin2hex(random_bytes(50));
        // Set token expiration to 5 minutes from now
        $tokenExpiration = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        // Save the token in the database with an expiration time using prepared statement
        $updateTokenSql = "UPDATE users SET reset_token = ?, reset_token_expire = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateTokenSql);
        $updateStmt->bind_param('sss', $token, $tokenExpiration, $email);

        if ($updateStmt->execute()) {
            // Generate the password reset link
            $resetLink = "http://localhost/bellaChica/reset_password.php?token=" . $token;

            // PHPMailer instance
            $mail = new PHPMailer(true);
            try {
                // Server settings for Gmail SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'jd.version2.0@gmail.com'; // SMTP username (your Gmail)
                $mail->Password = 'owjc tvri gvat ocuq'; // SMTP password (use app-specific password)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port = 587; // TCP port to connect to

                // Recipients
                $mail->setFrom('jd.version2.0@gmail.com', 'Bella Chica Beauty Studio'); // Sender email and name
                $mail->addAddress($email); // Add recipient email

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = "
                    <h2>Password Reset Request</h2>
                    <p>Click the link below to reset your password:</p>
                    <a href='$resetLink'>$resetLink</a>
                    <p>If you did not request a password reset, please ignore this email.</p>
                ";
                $mail->AltBody = "Click the following link to reset your password: $resetLink";

                // Send email
                $mail->send();
                echo 'Password reset instructions have been sent to your email.';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error updating reset token: " . $conn->error;
        }
    } else {
        echo "No user found with that email address.";
    }

    $stmt->close(); // Close the prepared statement
}

$conn->close(); // Close the database connection
?>
