<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
    header('location:logout.php');
} else {
    // Code for deletion
    if($_GET['action']=='delete') {
        $id = intval($_GET['id']);
        $query = mysqli_query($con, "delete from tblservices where ID='$id'");
        if ($query) {
            echo "<script>alert('Service deleted.');</script>";
            echo "<script>window.location.href='manage-services.php'</script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
            echo "<script>window.location.href='manage-services.php'</script>";
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>BCBS || Manage Services</title>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <!--//Metis Menu -->
    <!--webfonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script> new WOW().init(); </script>
    <!--//end-animate-->
    <style>
        /* Custom CSS for table */
        .table {
            border: none;
            border-collapse: collapse;
            width: 100%;
        }
        .table th, .table td {
            border: none;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body class="cbp-spmenu-push">
<div class="main-content">
    <!--left-fixed -navigation-->
    <?php include_once('includes/sidebar.php'); ?>
    <!--left-fixed -navigation-->
    <!-- header-starts -->
    <?php include_once('includes/header.php'); ?>
    <!-- //header-ends -->
    <!-- main content start-->
    <div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                <h3 class="title1">Manage Services</h3>
                <div class="table-responsive bs-example widget-shadow">
                    <h4>Update Services:</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Service Name</th>
                            <th>Service Price</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ret = mysqli_query($con, "SELECT tblservices.*, tblcategories.CategoryName FROM tblservices INNER JOIN tblcategories ON tblservices.CategoryID = tblcategories.CategoryID");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($ret)) {
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['CategoryName']; ?></td>
                                <td><?php echo $row['ServiceName']; ?></td>
                                <td><?php echo '₱' . number_format($row['Cost'], 2); ?></td>
                                <td><?php echo $row['CreationDate']; ?></td>
                                <td>
                                    <a href="edit-services.php?editid=<?php echo $row['ID']; ?>"><i class="fa fa-edit"></i></a> |
                                    <a href="manage-services.php?action=delete&&id=<?php echo $row['ID']; ?>"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                            $cnt++;
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--footer-->
    <?php include_once('includes/footer.php'); ?>
    <!--//footer-->
</div>
<!-- Classie -->
<script src="js/classie.js"></script>
<script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };

    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
</script>
<!--scrolling js-->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!--//scrolling js-->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>
</body>
</html>
