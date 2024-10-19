<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit; // Ensure script stops execution after redirect
} else {
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>BCBS || All Appointment</title>
        <script type="application/x-javascript"> 
            addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
            function hideURLbar(){ window.scrollTo(0,1); } 
        </script>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- Custom CSS -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <!-- font-awesome icons -->
        <link href="css/font-awesome.css" rel="stylesheet"> 
        <!-- animate CSS -->
        <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
        <!-- Metis Menu -->
        <link href="css/custom.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <style>
            .table-bordered {
                border: none;
            }
            .table-bordered > thead > tr > th,
            .table-bordered > tbody > tr > td {
                border: none;
                padding: 8px;
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
                        <h3 class="title1">All Appointments</h3>
                        <div class="table-responsive bs-example widget-shadow">
                            <h4>All Appointments:</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Appointment Number</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Services</th> <!-- New column for Services -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM tblappointment ORDER BY AptDate DESC";
                                    $result = mysqli_query($con, $query);
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $appointmentId = $row['ID'];
                                        $aptNumber = $row['AptNumber'];
                                        $name = $row['Name'];
                                        $phone = $row['PhoneNumber'];
                                        $aptDate = $row['AptDate'];
                                        $aptTime = $row['AptTime'];

                                        // Fetch services for this appointment
                                        $serviceIds = explode(',', $row['Services']);
                                        $services = [];
                                        foreach ($serviceIds as $serviceId) {
                                            $serviceQuery = $con->prepare("SELECT ServiceName FROM tblservices WHERE ID = ?");
                                            $serviceQuery->bind_param("i", $serviceId);
                                            $serviceQuery->execute();
                                            $serviceResult = $serviceQuery->get_result();
                                            $serviceRow = $serviceResult->fetch_assoc();
                                            if ($serviceRow) {
                                                $services[] = $serviceRow['ServiceName'];
                                            }
                                            $serviceQuery->close();
                                        }
                                        $servicesText = implode(', ', $services);
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $aptNumber; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $phone; ?></td>
                                            <td><?php echo $aptDate; ?></td>
                                            <td><?php echo $aptTime; ?></td>
                                            <td><?php echo $servicesText; ?></td> <!-- Display services -->
                                            <td><a href="view-appointment.php?viewid=<?php echo $appointmentId; ?>">View</a></td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>
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
        <script src="js/bootstrap.js"> </script>
    </body>
    </html>
<?php } ?>
