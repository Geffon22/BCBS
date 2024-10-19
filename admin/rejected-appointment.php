<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit();
} 

?>

<!DOCTYPE HTML>
<html>
<head>
<title>BCBS || Rejected Appointment</title>
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
                <h3 class="title1">Rejected Appointment</h3>
                <div class="table-responsive bs-example widget-shadow">
                    <h4>Rejected Appointment:</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Appointment Number</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $con->prepare("SELECT * FROM tblappointment WHERE Status = ?");
                            $status = 2;
                            $stmt->bind_param("i", $status);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $cnt = 1;
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $cnt;?></td>
                                    <td><?php echo htmlspecialchars($row['AptNumber']);?></td>
                                    <td><?php echo htmlspecialchars($row['Name']);?></td>
                                    <td><?php echo htmlspecialchars($row['PhoneNumber']);?></td>
                                    <td><?php echo htmlspecialchars($row['AptDate']);?></td>
                                    <td><?php echo htmlspecialchars($row['AptTime']);?></td>
                                    <td><a href="view-appointment.php?viewid=<?php echo $row['ID'];?>">View</a></td>
                                </tr>
                                <?php 
                                $cnt++;
                            }
                            ?>
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
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"> </script>
</body>
</html>

