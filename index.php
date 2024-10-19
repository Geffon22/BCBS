<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Bella Chica Beauty Studio || Home Page</title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

     
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
    <?php include_once('includes/header.php');?>
   <!-- Carousel Start -->
<div class="container-fluid carousel-header px-0">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="images/c1.jpg" class="img-fluid" alt="Image">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-primary text-uppercase mb-3">Bella Chica Beauty Studio</h4>
                        <h1 class="display-1 text-capitalize text-dark mb-3">Gluta Drip</h1>
                        <p class="mx-md-5 fs-4 px-4 mb-5 text-dark">Start your healthy beauty habits now that your future self will thank you.</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5 appointment-link" href="appointment.php">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/c2.jpg" class="img-fluid" alt="Image">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-primary text-uppercase mb-3" style="letter-spacing: 3px;">Bella Chica Beauty Studio</h4>
                        <h1 class="display-1 text-capitalize text-dark mb-3">6D Microblading</h1>
                        <p class="mx-md-5 fs-4 px-5 mb-5 text-dark"> is also known as 6D Eyebrows, Eyebrow Embriodery, or Eyebrow Feathering.</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5 appointment-link" href="appointment.php">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/hero-img.png" class="img-fluid" alt="Image">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-primary text-uppercase mb-3" style="letter-spacing: 3px;">Bella Chica Beauty Studio</h4>
                        <h1 class="display-1 text-capitalize text-dark">𝗠𝗲𝘀𝗼𝗹𝗶𝗽𝗼</h1>
                        <p class="mx-md-5 fs-4 px-5 mb-5 text-dark">Infusion of vitamins and enzymes that dissolve the accumulated fatty tissue under the skin.</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5 appointment-link" href="appointment.php">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

<script>
    $(document).ready(function() {
        $('.appointment-link').on('click', function(e) {
            if (!$(this).data('logged-in')) {
                e.preventDefault();
                $('#notLoggedInModal').modal('show');
                // Set a timeout to close the modal after 2 seconds
                setTimeout(function() {
                    $('#notLoggedInModal').modal('hide');
                }, 5000);
            }
        });
    });
</script>

        <!-- Team Start -->
        <div class="container-fluid team py-5">
            <div class="container py-5">
                <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                    <p class="fs-4 text-uppercase text-primary">Team Bella Chica - Dagupan Branch</p>
                    <h1 class="display-4 mb-4">Beauty Clinic Specialist</h1>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="team-item">
                            <div class="team-img rounded-top">
                                <img src="images/s1.jpg" class="img-fluid w-100 rounded-top bg-light" alt="">
                            </div>
                            <div class="team-text rounded-bottom text-center p-4">
                                <h3 class="text-white">Rhean Lagao</h3>
                                <p class="mb-0 text-white"> Admin Officer / Premium Services</p>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="team-item">
                            <div class="team-img rounded-top">
                                <img src="images/s7.jpg" class="img-fluid w-100 rounded-top bg-light" alt="">
                            </div>
                            <div class="team-text rounded-bottom text-center p-4">
                                <h3 class="text-white">Carolyn Dela Cruz </h3>
                                <p class="mb-0 text-white">Office In Charge</p>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="team-item">
                            <div class="team-img rounded-top">
                                <img src="images/s2.jpg" class="img-fluid w-100 rounded-top bg-light" alt="">
                            </div>
                            <div class="team-text rounded-bottom text-center p-4">
                                <h3 class="text-white">Catrina Rocomuada</h3>
                                <p class="mb-0 text-white">Therapists Artist</p>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="team-item">
                            <div class="team-img rounded-top">
                                <img src="images/s3.jpg" class="img-fluid w-100 rounded-top bg-light" alt="">
                            </div>
                            <div class="team-text rounded-bottom text-center p-4">
                                <h3 class="text-white">Shiela Mae Corpuz </h3>
                                <p class="mb-0 text-white">Therapist Artists</p>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="team-item">
                            <div class="team-img rounded-top">
                                <img src="images/s4.jpg" class="img-fluid w-100 rounded-top bg-light" alt="">
                            </div>
                            <div class="team-text rounded-bottom text-center p-4">
                                <h3 class="text-white">Charmee Solano </h3>
                                <p class="mb-0 text-white">Therapist Artists</p>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="team-item">
                            <div class="team-img rounded-top">
                                <img src="images/s5.jpg" class="img-fluid w-100 rounded-top bg-light" alt="">
                            </div>
                            <div class="team-text rounded-bottom text-center p-4">
                                <h3 class="text-white">Kisha Carane </h3>
                                <p class="mb-0 text-white">Therapist</p>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="team-item">
                            <div class="team-img rounded-top">
                                <img src="images/s6.jpg" class="img-fluid w-100 rounded-top bg-light" alt="">
                            </div>
                            <div class="team-text rounded-bottom text-center p-4">
                                <h3 class="text-white">Ginalyn Rocomuda </h3>
                                <p class="mb-0 text-white">Therapist</p>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="team-item">
                            <div class="team-img rounded-top">
                                <img src="images/s8.jpg" class="img-fluid w-100 rounded-top bg-light" alt="">
                            </div>
                            <div class="team-text rounded-bottom text-center p-4">
                                <h3 class="text-white">Judy Ann Maramba </h3>
                                <p class="mb-0 text-white">Therapist</p>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-light btn-light-outline-0 btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->
       
        <!-- Testimonial Start -->
        <div class="container-fluid testimonial py-5" style="background:#cf5aa0;">
            <div class="container py-5">
                <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                <h3 class="text-white">Testimonial</h3>
                    <h5 class="display-4 mb-4 text-white">What Our Clients Say!</h5>
                </div>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item rounded p-4">
                        <div class="row">
                            <div class="col-4">
                                <div class="d-flex flex-column mx-auto">
                                    <div class="rounded-circle mb-4 fixed-size" style="border: dashed; border-color: var(--bs-white);">
                                        <img src="images/cp1.jpg" class="img-fluid rounded-circle " alt="">
                                    </div>
                                    <div class="text-center">
                                        <h4 class="mb-2 text-primary">Abigail Ubaldo Santos</h4>
                                        <p class="m-0 text-white">Client</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="position-absolute" style="top: 20px; right: 25px;">
                                    <i class="fa fa-quote-right fa-2x text-secondary"></i>
                                </div>
                                <div class="testimonial-content">

                                <br>

                                    <div class="d-flex mb-4">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>

                                <br>
                                    
                                    <p class="fs-5 mb-0 text-white">Thank you BellaChica Dagupan for my brows and topliners. Napakaganda ng ambiance sa loob, malinis at napaka welcoming at entertaining ng staffs. Sobrang ganda pa ng work of hands nila. Very Well Recommended beauty clinic!
                                    </p>

                                    

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item rounded p-4">
                        <div class="row">
                            <div class="col-4">
                                <div class="d-flex flex-column mx-auto">
                                    <div class="rounded-circle mb-4 fixed-size" style="border: dashed; border-color: var(--bs-white);">
                                        <img src="images/cp2.jpg" class="img-fluid rounded-circle " alt="" style="height: 100%; width: 100%; object-fit: cover;">
                                    </div>
                                    <div class="text-center">
                                        <h4 class="mb-2 text-primary">Jamille Anne Laquindanum Fajarfo</h4>
                                        <p class="m-0 text-white">Client</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="position-absolute" style="top: 20px; right: 25px;">
                                    <i class="fa fa-quote-right fa-2x text-secondary"></i>
                                </div>
                                <div class="testimonial-content">

                                 <br>

                                    <div class="d-flex mb-4">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>


                                        <br>

                                    <p class="fs-5 mb-0 text-white">Thank you so much Bella Chica. 😍 Highly recommended. super bait Ng mga staff at Ang gaan Ng kamay Ng gumawa ng eyelash ko. ❤️</p>

                                       
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item rounded p-4">
                        <div class="row">
                            <div class="col-4">
                                <div class="d-flex flex-column mx-auto">
                                    <div class="rounded-circle mb-4 fixed-size" style="border: dashed; border-color: var(--bs-white);">
                                        <img src="images/t13.jpg" class="img-fluid rounded-circle " alt="" style="height: 100%; width: 100%; object-fit: cover;">
                                    </div>
                                    <div class="text-center">
                                        <h4 class="mb-2 text-primary">Helen Bustillo Bernal</h4>
                                        <p class="m-0 text-white">Client</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="position-absolute" style="top: 20px; right: 25px;">
                                    <i class="fa fa-quote-right fa-2x text-secondary"></i>
                                </div>
                                <div class="testimonial-content">

                                <br>

                                    <div class="d-flex mb-4">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>

                                <br>
                                   
                                    <p class="fs-5 mb-0 text-white">Hi Bella chica Dagupan.. thank you for making me fresh and beautiful as always.</p>
                                    </p>

                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       


        <?php include_once('includes/footer.php');?>
    <!-- /.footer-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menumaker.js"></script>
    <!-- sticky header -->
    <script src="js/jquery.sticky.js"></script>
    <script src="js/sticky-header.js"></script>

     <!-- JavaScript Libraries -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>