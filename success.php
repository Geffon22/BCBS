<?php
session_start();
if (!isset($_SESSION['aptno'])) {
    header('Location: index.php'); // Redirect to home if accessed directly
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bella Chica Beauty Studio || Appointment Success</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php include_once('includes/header.php'); ?>
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <br>
                    <div class="page-caption">
                        <h2 class="page-title">Appointment Booked Successfully</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Appointment Success</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h1>Thank You!</h1>
                            <p>Your appointment has been successfully booked. Your appointment number is <strong><?php echo $_SESSION['aptno']; ?></strong>. Please save this number for future reference.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <?php include_once('includes/footer.php'); ?>
</body>
</html>

<?php
// Clear the session variable to prevent resubmission on page refresh
unset($_SESSION['aptno']);
?>