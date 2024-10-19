<?php
session_start();
include('includes/dbconnection.php');

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['submit'])) {
    function validateTime($selectedTime, $existingTimes) {
        foreach ($existingTimes as $existingTime) {
            if ($existingTime === $selectedTime) {
                return "This time slot is already taken. Please select another time.";
            }

            // Check if the selected time is within 30 minutes of existing time
            $diff = abs(strtotime($existingTime) - strtotime($selectedTime));
            $minutesDiff = floor($diff / 60);
            if ($minutesDiff < 30) {
                return "Please select another time. Time slot should be at least 30 minutes apart.";
            }
        }
        return ""; // Validation passed
    }

    // Sanitize and validate form data
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $services = array_map('intval', $_POST['services']);
    $adate = filter_var($_POST['adate'], FILTER_SANITIZE_STRING);
    $atime = filter_var($_POST['atime'], FILTER_SANITIZE_STRING);
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
    $aptnumber = mt_rand(100000000, 999999999);

    // Server-side validation: Check for existing appointments at the same time
    $existingTimes = [];
    $stmt = $con->prepare("SELECT AptTime FROM tblappointment WHERE AptDate = ?");
    $stmt->bind_param("s", $adate);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $existingTimes[] = $row['AptTime'];
    }
    $stmt->close();

    $timeValidation = validateTime($atime, $existingTimes);
    if ($timeValidation !== "") {
        $_SESSION['error'] = $timeValidation;
        header('Location: appointment.php'); // Redirect back to form with an error message
        exit();
    }

    // Additional validation: Ensure selected time is within 9:00 AM - 9:00 PM
    $openingTime = strtotime('09:00');
    $closingTime = strtotime('21:00');
    $selectedTime = strtotime($atime);

    if ($selectedTime < $openingTime || $selectedTime > $closingTime) {
        $_SESSION['error'] = 'Please select a time between 9:00 AM and 9:00 PM.';
        header('Location: appointment.php');
        exit();
    }

    // Calculate total service price and prepare details for insertion
    $totalPrice = 0;
    $serviceDetails = [];
    foreach ($services as $serviceId) {
        $stmt = $con->prepare("SELECT ServiceName, Cost FROM tblservices WHERE ID = ?");
        $stmt->bind_param("i", $serviceId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $serviceName = $row['ServiceName'];
            $servicePrice = $row['Cost'];
            $totalPrice += $servicePrice;
            $serviceDetails[] = [
                'name' => $serviceName,
                'price' => $servicePrice
            ];
        }
        $stmt->close();
    }

    // Insert into database using prepared statement
    $servicesList = implode(', ', array_column($serviceDetails, 'name'));
    $stmt = $con->prepare("INSERT INTO tblappointment (AptNumber, Name, Email, PhoneNumber, AptDate, AptTime, Services, TotalPrice) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssdi", $aptnumber, $name, $email, $phone, $adate, $atime, $servicesList, $totalPrice);
    
    if ($stmt->execute()) {
        $_SESSION['aptno'] = $aptnumber;
        header('Location: success.php'); // Redirect to a success page
        exit();
    } else {
        $_SESSION['error'] = 'Failed to book appointment. Please try again.';
        header('Location: appointment.php'); // Redirect back to form with an error message
        exit();
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bella Chica Beauty Studio || Appointments Form</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('includes/header.php'); ?>
    
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <div class="page-caption">
                        <h2 class="page-title">Appointment</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Appointment</li>
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
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <h1>Appointment Form</h1>
                    <p>Book your appointment to avoid the rush.</p>
                    
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                        unset($_SESSION['error']);
                    }
                    ?>
                    
                    <form method="post">
                        <div class="form-group row">
                           
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact No." required maxlength="10" pattern="[0-9]+">
                            </div>
                        </div>

                        <div class="form-group row">
                           
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="appointment_email" name="email" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6" for="services">Select Services</label>
                            <div class="col-sm-8">
                                <select name="services[]" id="services" class="form-control select2" multiple required onchange="updateServicePrice()">
                                    <option value=""></option>
                                    <?php 
                                    $categoryQuery = mysqli_query($con, "SELECT * FROM tblcategories");
                                    while ($categoryRow = mysqli_fetch_array($categoryQuery)) {
                                        $categoryId = $categoryRow['CategoryID'];
                                        $categoryName = $categoryRow['CategoryName'];
                                        echo "<optgroup label='$categoryName' style='font-weight:bold;'>";
                                        
                                        $serviceQuery = mysqli_query($con, "SELECT * FROM tblservices WHERE CategoryID='$categoryId'");
                                        while ($serviceRow = mysqli_fetch_array($serviceQuery)) {
                                            $serviceId = $serviceRow['ID'];
                                            $serviceName = $serviceRow['ServiceName'];
                                            $servicePrice = $serviceRow['Cost'];
                                            echo "<option value='$serviceId' data-price='$servicePrice'>$serviceName - ₱" . number_format($servicePrice, 2) . "</option>";
                                        }
                                        echo "</optgroup>";
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label>Total Price</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="total" readonly>
                            </div>
                            <div class="form-group row">
                            <label  for="inputdate">Appointment Date</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="adate" id="inputdate" required min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="atime">Appointment Time</label>
                            <div class="col-sm-2">
                                <input type="time" class="form-control" name="atime" id="atime" required min="09:00" max="21:00">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-4">
                                <button type="submit" name="submit" class="btn btn-primary btn-primary-outline-0 rounded-pill py-3">Book Appointment</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });

        function updateServicePrice() {
            var total = 0;
            $('#services option:selected').each(function() {
                var price = parseFloat($(this).data('price'));
                total += price;
            });
            $('#total').val('₱' + total.toFixed(2)); // Format total with currency symbol
        }
    </script>
</body>
</html>
