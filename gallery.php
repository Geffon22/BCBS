<?php
session_start();
include('includes/dbconnection.php'); 

function fetchImages($con) {
    $ret = mysqli_query($con, "SELECT * FROM tblgallery");
    if (!$ret) {
        die("Query failed: " . mysqli_error($con));
    }
    $images = mysqli_fetch_all($ret, MYSQLI_ASSOC);
    return $images;
}

function fetchCategories($con) {
    $ret = mysqli_query($con, "SELECT * FROM tblcategories");
    if (!$ret) {
        die("Query failed: " . mysqli_error($con));
    }
    $categories = mysqli_fetch_all($ret, MYSQLI_ASSOC);
    return $categories;
}

$images = fetchImages($con);
$categories = fetchCategories($con);

mysqli_close($con); // Close the database connection here after fetching data
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bella Chica Beauty Studio || Gallery</title>
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
    <?php include_once('includes/header.php'); ?>

    <!-- Gallery Start -->
    <div class="container-fluid gallery py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                <p class="fs-4 text-uppercase text-primary">Our Gallery</p>
                <h1 class="display-4 mb-4">Let's See Our Gallery</h1>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-all">
                            <span class="text-dark" style="width: 150px;">All Gallery</span>
                        </a>
                    </li>
                    <?php foreach ($categories as $category): ?>
                    <li class="nav-item">
                        <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-<?php echo $category['CategoryID']; ?>">
                            <span class="text-dark" style="width: 150px;"><?php echo $category['CategoryName']; ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content">
                    <div id="tab-all" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <?php if (!empty($images)): ?>
                            <?php foreach ($images as $image): ?>
                            <div class="col-lg-3">
                                <div class="gallery-img">
                                    <img class="img-fluid rounded w-100" src="admin/<?php echo $image['ImagePath']; ?>" alt="<?php echo $image['ImageName']; ?>">
                                    <div class="gallery-overlay p-4">
                                        <h4 class="text-secondary"><?php echo $image['ImageName']; ?></h4>
                                    </div>
                                    <div class="search-icon">
                                        <a href="admin/<?php echo $image['ImagePath']; ?>" data-lightbox="Gallery" class="my-auto"><i class="fas fa-search-plus btn-primary btn-primary-outline-0 rounded-circle p-3"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <div class="col-md-12">
                                <p>No images found.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php foreach ($categories as $category): ?>
                    <div id="tab-<?php echo $category['CategoryID']; ?>" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <?php
                            $category_id = $category['CategoryID'];
                            $category_images = array_filter($images, function($img) use ($category_id) {
                                return $img['ImageCategory'] == $category_id;
                            });
                            ?>
                            <?php if (!empty($category_images)): ?>
                            <?php foreach ($category_images as $image): ?>
                            <div class="col-lg-3">
                                <div class="gallery-img">
                                    <img class="img-fluid rounded w-100" src="admin/<?php echo $image['ImagePath']; ?>" alt="<?php echo $image['ImageName']; ?>">
                                    <div class="gallery-overlay p-4">
                                        <h4 class="text-secondary"><?php echo $image['ImageName']; ?></h4>
                                    </div>
                                    <div class="search-icon">
                                        <a href="admin/<?php echo $image['ImagePath']; ?>" data-lightbox="Gallery" class="my-auto"><i class="fas fa-search-plus btn-primary btn-primary-outline-0 rounded-circle p-3"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <div class="col-md-12">
                                <p>No images found in this category.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery End -->
    <?php include_once('includes/footer.php'); ?>

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
