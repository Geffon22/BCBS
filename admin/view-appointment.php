<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $cid = $_GET['viewid'];
        $remark = $_POST['remark'];
        $status = $_POST['status'];
        $query = mysqli_query($con, "UPDATE tblappointment SET Remark='$remark', Status='$status' WHERE ID='$cid'");
        if ($query) {
            echo '<script>alert("All remarks have been updated")</script>';
        } else {
            echo '<script>alert("Something Went Wrong. Please try again.")</script>';
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>BCBS || View Appointment</title>
<script type="application/x-javascript"> 
    addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
    function hideURLbar() { window.scrollTo(0, 1); } 
</script>
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
        <?php include_once('includes/sidebar.php'); ?>
        <!-- header-starts -->
        <?php include_once('includes/header.php'); ?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">View Appointment</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <p style="font-size:16px; color:red" align="center"> <?php if ($msg) { echo $msg; } ?> </p>
                        <h4>View Appointment:</h4>
                        <?php
                        $cid = $_GET['viewid'];
                        $ret = mysqli_query($con, "SELECT * FROM tblappointment WHERE ID='$cid'");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($ret)) {
                            // Fetch service names
                            $serviceIds = explode(',', $row['Services']);
                            $serviceNames = [];
                            foreach ($serviceIds as $serviceId) {
                                $serviceQuery = mysqli_query($con, "SELECT ServiceName FROM tblservices WHERE ID='$serviceId'");
                                $serviceRow = mysqli_fetch_array($serviceQuery);
                                $serviceNames[] = $serviceRow['ServiceName'];
                            }
                            $servicesText = implode(', ', $serviceNames);
                        ?>
                        <table class="table">
                            <tr>
                                <th>Appointment Number</th>
                                <td><?php echo $row['AptNumber']; ?></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?php echo $row['Name']; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $row['Email']; ?></td>
                            </tr>
                            <tr>
                                <th>Mobile Number</th>
                                <td><?php echo $row['PhoneNumber']; ?></td>
                            </tr>
                            <tr>
                                <th>Appointment Date</th>
                                <td><?php echo $row['AptDate']; ?></td>
                            </tr>
                            <tr>
                                <th>Appointment Time</th>
                                <td><?php echo $row['AptTime']; ?></td>
                            </tr>
                            <tr>
                                <th>Services</th>
                                <td><?php echo $servicesText; ?></td>
                            </tr>
                            <tr>
                                <th>Total Price</th>
                                <td>₱<?php echo number_format($row['TotalPrice'], 2); ?></td>
                            </tr>
                            <tr>
                                <th>Apply Date</th>
                                <td><?php echo $row['ApplyDate']; ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <?php
                                    if ($row['Status'] == "1") {
                                        echo "Selected";
                                    }
                                    if ($row['Status'] == "2") {
                                        echo "Rejected";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <table class="table">
                            <?php if ($row['Remark'] == "") { ?>
                            <form name="submit" method="post" enctype="multipart/form-data">
                                <tr>
                                    <th>Remark :</th>
                                    <td>
                                        <textarea name="remark" placeholder="" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status :</th>
                                    <td>
                                        <select name="status" class="form-control wd-450" required="true">
                                            <option value="1" selected="true">Selected</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td colspan="2"><button type="submit" name="submit" class="btn btn-az-primary pd-x-20">Submit</button></td>
                                </tr>
                            </form>
                            <?php } else { ?>
                        </table>
                        <table class="table">
                            <tr>
                                <th>Remark</th>
                                <td><?php echo $row['Remark']; ?></td>
                            </tr>
                            <tr>
                                <th>Remark date</th>
                                <td><?php echo $row['RemarkDate']; ?></td>
                            </tr>
                        </table>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!--footer-->
        
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
    <script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>
