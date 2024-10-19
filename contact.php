<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bella Chica Beauty Studio || Contact Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Custom Styles -->
    <style>
        .contact-info,
        .about-section {
            background: #f9f9f9;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .contact-info h3,
        .about-section h1 {
            margin-bottom: 20px;
            font-weight: 600;
        }
        .social-circle a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            margin-right: 10px;
            border-radius: 50%;
            background: #007bff;
            color: #fff;
        }
        .social-circle a:hover {
            background: #0056b3;
            text-decoration: none;
        }
        .slider {
            margin-top: 20px;
        }
        .slider img {
            max-width: 100%;
            height: 500px;
            border-radius: 8px;
        }
    </style>

    
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <br>
                <div class="page-caption">
                    <h2 class="page-title">Services</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Services</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="contact-info">
                <?php
                $ret = mysqli_query($con, "select * from tblpage where PageType='contactus' ");
                while ($row = mysqli_fetch_array($ret)) {
                ?>
                <h3>Contact Info</h3>
                <address>
                    <strong>Address:</strong><br>
                    <?php echo $row['PageDescription']; ?>
                    <br><br>
                    <strong>Mobile #:</strong> 0<?php echo $row['MobileNumber']; ?>
                </address>
                <address>
                    <strong>Email:</strong><br>
                    <?php echo $row['Email']; ?>
                </address>
                <address>
                    <strong>Time:</strong><br>
                    <?php echo $row['Timing']; ?>
                </address>
                <?php } ?>
            </div>
            <div class="widget widget-social">
                <div class="social-circle">
                    <a href="#" class="text-decoration-none"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-decoration-none"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-decoration-none"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-decoration-none"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="about-section">
                <?php
                $ret = mysqli_query($con, "select * from tblpage where PageType='aboutus' ");
                while ($row = mysqli_fetch_array($ret)) {
                ?>
                <h1><?php echo $row['PageTitle']; ?></h1>
                <div class="slider">
                    <div><img src="images/aboutus.png" alt="About Us" class="img-fluid"></div>
                    <div><img src="images/aboutus.jpg" alt="About Us" class="img-fluid"></div>
                    <div><img src="images/au1.jpg" alt="About Us" class="img-fluid"></div>
                </div>
                <h3>Best Experience Ever</h3>
                <p><?php echo $row['PageDescription']; ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include_once('includes/footer.php'); ?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Slick Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('.slider').slick({
            autoplay: true,
            autoplaySpeed: 3000,
            dots: true,
            arrows: false,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1
        });
    });
</script>
</body>

</html>
