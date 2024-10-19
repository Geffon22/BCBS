<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'])==0) {
    header('location:logout.php');
} else{
    // Code for deletion
    if($_GET['action']=='delete')
    {
        $id=intval($_GET['id']);
        $query=mysqli_query($con,"DELETE FROM tblcategories WHERE CategoryID='$id'");
        if ($query) {
            echo "<script>alert('Category deleted.');</script>";
            echo "<script>window.location.href='manage-categories.php'</script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
            echo "<script>window.location.href='manage-categories.php'</script>";
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>BCBS || Manage Categories</title>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <!--webfonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script> new WOW().init(); </script>
    <!--end-animate-->
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
    <?php include_once('includes/sidebar.php');?>
    <!--left-fixed -navigation-->
    <!-- header-starts -->
    <?php include_once('includes/header.php');?>
    <!-- //header-ends -->
    <!-- main content start-->
    <div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                <h3 class="title1">Manage Categories</h3>
                <div class="table-responsive bs-example widget-shadow">
                    <h4>Update Categories:</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ret=mysqli_query($con,"SELECT * FROM tblcategories");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($ret)) {
                            ?>
                            <tr>
                                <td><?php echo $cnt;?></td>
                                <td><?php  echo $row['CategoryName'];?></td>
                                <td>
                                    <a href="edit-category.php?editid=<?php echo $row['CategoryID'];?>"><i class="fa fa-edit"></i></a> |
                                    <a href="manage-categories.php?action=delete&id=<?php echo $row['CategoryID'];?>" onclick="return confirm('Are you sure you want to delete this category?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                            $cnt++;
                        }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--footer-->
    <?php include_once('includes/footer.php');?>
    <!--//footer-->
</div>
<!-- Classie -->
<script src="js/classie.js"></script>
<script>
    var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
        showLeftPush = document.getElementById( 'showLeftPush' ),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle( this, 'active' );
        classie.toggle( body, 'cbp-spmenu-push-toright' );
        classie.toggle( menuLeft, 'cbp-spmenu-open' );
        disableOther( 'showLeftPush' );
    };

    function disableOther( button ) {
        if( button !== 'showLeftPush' ) {
            classie.toggle( showLeftPush, 'disabled' );
        }
    }
</script>
<!--scrolling js-->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!--//scrolling js-->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"> </script>
</body>
</html>
