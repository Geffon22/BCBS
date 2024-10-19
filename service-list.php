<?php
session_start();
include('includes/dbconnection.php'); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bella Chica Beauty Studio || Services</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- VenoBox -->
    <link rel="stylesheet" href="css/venobox.css" type="text/css" media="screen" />
    <!-- Style -->
    <link rel="stylesheet" href="css/category.css">

    <style>
        .book-now-button {
            float: left; /* Aligns the button to the left */
            margin-top: 20px; /* Adds some space from the services list */
        }
    </style>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="mb-4">Select Category</h2>
                <div class="category-list perfect-scrollbar" onmouseenter="showScrollbar(this)" onmouseleave="hideScrollbar(this)">
                    <?php
                    // Select distinct categories
                    $categories_query = "SELECT DISTINCT tblcategories.CategoryID, tblcategories.CategoryName FROM tblservices INNER JOIN tblcategories ON tblservices.CategoryID = tblcategories.CategoryID ORDER BY tblcategories.CategoryName";
                    $categories_result = mysqli_query($con, $categories_query);
                    ?>
                    <?php while ($category = mysqli_fetch_assoc($categories_result)) : ?>
                        <div class="category-name" onclick="toggleServices(<?php echo $category['CategoryID']; ?>)"><?php echo $category['CategoryName']; ?></div>
                    <?php endwhile; ?>
                </div>
                <!-- Add buttons for scrolling -->
                <div class="scroll-buttons mt-3">
                    <button onclick="scrollCategoryList(-50)" class="btn rounded-0 mr-2"><i class="fa fa-chevron-up"></i></button>
                    <button onclick="scrollCategoryList(50)" class="btn rounded-0"><i class="fa fa-chevron-down"></i></button>
                    <br><br>
                </div>
            </div>
            <div class="col-md-9">
                <div class="service-list">
                    <h2 class="mb-4">Services Fee</h2>
                    <?php
                    // Fetch services for each category
                    $categories_result = mysqli_query($con, $categories_query);
                    while ($category = mysqli_fetch_assoc($categories_result)) :
                        $category_id = $category['CategoryID'];
                    ?>
                        <table class="table" id="services-<?php echo $category_id; ?>" style="<?php echo $category_id === '11' ? 'display: table;' : 'display: none;'; ?>">
                            <tbody>
                                <?php
                                // Select services for this category
                                $services_query = "SELECT * FROM tblservices WHERE CategoryID = '$category_id'";
                                $services_result = mysqli_query($con, $services_query);
                                while ($service = mysqli_fetch_assoc($services_result)) :
                                ?>
                                    <tr>
                                        <td class="service-name"><?php echo $service['ServiceName']; ?></td>
                                        <td class="service-fee"><span>&#8369;</span><?php echo number_format($service['Cost'], 2, '.', ','); ?></td>
                                        <td class="service-description"><?php echo $service['Description']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php endwhile; ?>

                    <!-- Book Button -->
                    <div class="text-left book-now-button">
                        <a class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5 appointment-link" href="appointment.php" data-logged-in="<?php echo isset($_SESSION['user_logged_in']) ? 'true' : 'false'; ?>">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Not Logged In Modal -->
<div class="modal fade" id="notLoggedInModal" tabindex="-1" role="dialog" aria-labelledby="notLoggedInModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notLoggedInModalLabel">Login Required</h5>
            </div>
            <div class="modal-body">
                You need to log in first before you can book an appointment.
            </div>
        </div>
    </div>
</div>
<!-- END Not Logged In Modal -->

<?php include_once('includes/footer.php'); ?>
<script src="js/jquery.min.js"></script>
<!-- Perfect Scrollbar JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.2/perfect-scrollbar.min.js"></script>
<script>
    $(document).ready(function() {
        $('.perfect-scrollbar').perfectScrollbar();
    });

    function toggleServices(categoryId) {
        var serviceTables = document.querySelectorAll('.service-list table');
        serviceTables.forEach(function(table) {
            table.style.display = 'none';
        });
        var selectedTable = document.getElementById('services-' + categoryId);
        if (selectedTable) {
            selectedTable.style.display = 'table';
        }
    }

    function showScrollbar(element) {
        element.classList.add('hovered');
    }

    function hideScrollbar(element) {
        element.classList.remove('hovered');
    }

    function scrollCategoryList(scrollAmount) {
        var categoryList = document.querySelector('.perfect-scrollbar');
        categoryList.scrollTop += scrollAmount;
        // Add active class to buttons when clicked
        var buttons = document.querySelectorAll('.scroll-buttons button');
        buttons.forEach(function(button) {
            button.classList.add('active');
            setTimeout(function() {
                button.classList.remove('active');
            }, 300);
        });
    }

    $(document).ready(function() {
        $('.appointment-link').on('click', function(e) {
            // Check if the user is not logged in
            if ($(this).data('logged-in') === 'false') {
                e.preventDefault(); // Prevent the default action (navigation)
                $('#notLoggedInModal').modal('show');
                // Set a timeout to close the modal after 2 seconds
                setTimeout(function() {
                    $('#notLoggedInModal').modal('hide');
                }, 2000);
            }
        });
    });
</script>

<?php include_once('includes/footer.php'); ?>
<!-- jQuery and Bootstrap JS -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Other JS scripts -->
<script src="js/menumaker.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/sticky-header.js"></script>
</body>

</html>
