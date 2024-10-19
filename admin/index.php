<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

function login(){
    if(isset($_POST['login'])) {
        global $con;
        $adminuser = $_POST['username'];
        $password = md5($_POST['password']);
        $query = mysqli_query($con, "SELECT ID FROM tbladmin WHERE UserName='$adminuser' AND Password='$password'");
        $ret = mysqli_fetch_array($query);
        if($ret > 0) {
            $_SESSION['bpmsaid'] = $ret['ID'];
            echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    }
}

login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bella Chica | Login Page</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    
	<link rel="stylesheet" href="css/dlogin.css">
</head>
<body>
    <div class="login-container">
        <h2 class="title">Sign In</h2>
        <div class="login-box">
            <form class="login-form" method="post" action="">
                <div class="input-group">
                    <input type="text" class="input-field" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="password" class="input-field" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login" class="btn">Sign In</button>
                <div class="forgot-password">
                    <a href="../index.php">Back to Home</a>
                    <a href="forgot-password.php">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
