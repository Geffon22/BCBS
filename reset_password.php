<?php
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

// Enable error reporting for debugging purposes (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request is a POST request for password reset
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the token and new password from the POST request
    $token = $_POST['token'];
    $newPassword = $_POST['password'];

    // Validate that the token exists
    if (empty($token)) {
        echo "Token is missing. Please check your reset link.";
        exit;
    }

    // Debugging output to see the token received
    echo "Received token: " . htmlspecialchars($token) . "<br>";

    // Validate the new password (e.g., at least 8 characters)
    if (strlen($newPassword) < 8) {
        echo "Password must be at least 8 characters long.";
        exit;
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Check if token is valid and not expired
    $sql = "SELECT * FROM users WHERE reset_token = ? AND reset_token_expire > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    // Debugging output to check database results
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Fetch the user data

        echo "Token is valid.<br>";
        echo "Token expiration time: " . $user['reset_token_expire'] . "<br>";

        // Update the user's password
        $updatePasswordSql = "UPDATE users SET password = ?, reset_token = NULL, reset_token_expire = NULL WHERE reset_token = ?";
        $updateStmt = $conn->prepare($updatePasswordSql);
        $updateStmt->bind_param('ss', $hashedPassword, $token);
        
        if ($updateStmt->execute()) {
            // Redirect after successful password reset
            header("Location: index.php");
            exit;
        } else {
            error_log("Error resetting password: " . $conn->error);
            echo "An error occurred while resetting your password. Please try again later.";
        }
    } else {
        echo "Invalid or expired token.<br>";
        // Debugging output for expired tokens
        $expiredSql = "SELECT reset_token, reset_token_expire FROM users WHERE reset_token = ?";
        $expiredStmt = $conn->prepare($expiredSql);
        $expiredStmt->bind_param('s', $token);
        $expiredStmt->execute();
        $expiredResult = $expiredStmt->get_result();
        
        if ($expiredResult->num_rows > 0) {
            $expiredUser = $expiredResult->fetch_assoc();
            echo "The token was found, but it has expired.<br>";
            echo "Expiration time was: " . $expiredUser['reset_token_expire'] . "<br>";
        }
    }
} else {
    // In the GET request, get the token from the URL query
    $token = isset($_GET['token']) ? $_GET['token'] : null;

    // If no token is provided, show an error message
    if (empty($token)) {
        echo "Token is missing. Please check your reset link.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMv9fZgSo2bK5oJfC3U3rC4FYVRu9+8cWb9Yp" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .checkbox {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Your Password</h2>
        <form method="POST" action="reset_password.php">
            <!-- Pass the token value from GET to POST via hidden input -->
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <div>
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="checkbox" id="showPassword" class="checkbox" onclick="togglePasswordVisibility()"> Show Password
            </div>
            <div>
                <button type="submit">Reset Password</button>
            </div>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const showPasswordCheckbox = document.getElementById('showPassword');
            passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
        }
    </script>
</body>
</html>
