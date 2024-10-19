<?php
include('includes/dbconnection.php');
error_reporting(0);
session_start();

if(isset($_POST['sub'])) {
    $email = $_POST['email'];
    $query = mysqli_query($con, "insert into tblsubscriber(Email) value('$email')");
    
    if ($query) {
        echo "<script>alert('Your subscribe successfully!.');</script>";
        echo "<script>window.location.href ='index.php'</script>";
        exit; // Exit to prevent further execution
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
?>


<html>
<head>
    <meta charset="utf-8">
    <title>BCBS -Bella Chica Beauty Studio</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=PT+Serif:wght@400;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

        <body>

<!-- Footer Start -->
<div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <h4 class="mb-4 text-white">Newsletter</h4>
                            <p class="text-white">Enter your email address to receive new patient information and other useful information right to your inbox.</p>
                            <form method="post">
                            <div class="position-relative mx-auto rounded-pill">
                                <input class="form-control rounded-pill border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your email" name="email">
                                <button type="submit" value="submit" class="btn btn-primary btn-primary-outline-0 rounded-pill position-absolute top-0 end-0 py-2 mt-1 me-1" name="sub">SignUp</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Pages</h4>
                            <a href="index.php"><i class="fas fa-angle-right me-2"></i>Home</a>
                            <a href="Service-list.php"><i class="fas fa-angle-right me-2"></i> Services</a>
                            <a href="gallery.php"><i class="fas fa-angle-right me-2"></i>Gallery</a>
                            <a href="contact"><i class="fas fa-angle-right me-2"></i> About Us</a>
                            <a href="appointment.php"><i class="fas fa-angle-right me-2"></i> Appointment</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Schedule</h4>
                            <span class="text-white">Monday to Friday:  10:00 am – 08:00 pm</span></p>
                             <span class="text-white">Saturday: 09:00 am – 03:00 pm</span></p>
                             <span class="text-white">Sunday: 09:00 am – 01:00 pm</span></p>
                            <h4 class="my-4 text-white">Address</h4>
                            <p class="mb-0"><i class="fas fa-map-marker-alt text-default me-2"></i> DCU Bldg. Arellano St. Dagupan City, Ilocos Region, Philippines, Dagupan City, Philippines, 2400</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Other Branches FB Link</h4>
                            <a href="https://web.facebook.com/Bellachicadagupanbranch"><i class="fas fa-angle-right me-2"></i> Dagupan Branch</a>
                            <a href="https://web.facebook.com/profile.php?id=100083606137995&mibextid=ZbWKwL&_rdc=1&_rdr"><i class="fas fa-angle-right me-2"></i>Marikina Branch</a>
                            <a href="https://web.facebook.com/profile.php?id=100078628265203&mibextid=ZbWKwL&_rdc=1&_rdr"><i class="fas fa-angle-right me-2"></i> Makati Branch</a>

                            <h4 class="my-4 text-white">Contact Us</h4>
                            <p class="mb-0"><i class="fas fa-envelope text-default me-2"></i> bellachicadagupancity@gmail.com</p>
                            <p class="mb-0"><i class="fas fa-phone text-default me-2"></i> 0917 130 3274</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <br>
        <center><p>© Bella Chica Beauty Studio - 2024</p></center>

        <!-- Footer End -->


        </body>
</html>