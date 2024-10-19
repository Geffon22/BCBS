<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bella Chica Beauty Studio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <link href="css/dsidebar.css" rel="stylesheet">
    <style>
        /* Basic styles for sidebar and custom scrollbar */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            overflow-y: auto; /* Allow vertical scrolling */
            position: fixed; /* Fix the sidebar */
        }
        .nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .nav li {
            position: relative;
        }
        .nav a {
            display: block;
            padding: 15px;
            color: #fff;
            text-decoration: none;
        }
      
        .nav .nav-second-level {
            display: none; /* Hide submenus initially */
            padding-left: 20px; /* Indent sub-menu items */
            background-color: #F660AB; /* Darker background for submenus */
        }
        .nav .nav-second-level li a {
            padding: 10px; /* Less padding for sub-menu items */
        }
        .nav .nav-second-level.show {
            display: block; /* Show submenu when it has the class 'show' */
        }
    </style>
</head>
<body>

<nav class="sidebar" role="navigation" aria-label="Sidebar Navigation">
    <div class="navbar-collapse">
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
            <ul class="nav" id="leftCol" style="margin-top: 7%;">
                <!-- Sidebar Items -->
                <li>
                    <a href="dashboard.php"><i class="fa fa-home nav_icon"></i>Dashboard</a>
                </li>
                <li>
                    <a href="#" class="toggle-submenu"><i class="fa fa-cogs nav_icon"></i>Services Management <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="add-categories.php">Add Categories</a></li>
                        <li><a href="add-services.php">Add Services</a></li>
                        <li><a href="manage-categories.php">Manage Categories</a></li>
                        <li><a href="manage-services.php">Manage Services</a></li>
                    </ul>
                </li>
                <!-- More Sidebar Items -->
                <li>
                    <a href="#" class="toggle-submenu"><i class="fa fa-book nav_icon"></i>Content Management <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="about-us.php">About Us</a></li>
                        <li><a href="contact-us.php">Contact Us</a></li>
                        <li><a href="Gallery.php">Gallery</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="toggle-submenu"><i class="fa fa-check-square-o nav_icon"></i>Appointment Management <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="all-appointment.php">All Appointment</a></li>
                        <li><a href="new-appointment.php">New Appointment</a></li>
                        <li><a href="accepted-appointment.php">Approved Appointment</a></li>
                        <li><a href="rejected-appointment.php">Declined Appointment</a></li>
                    </ul>
                </li>
                <li><a href="subcriber.php" class="chart-nav"><i class="fa fa-user nav_icon"></i>Subscriber</a></li>
                <li><a href="add-customer.php" class="chart-nav"><i class="fa fa-user nav_icon"></i>Add Customer</a></li>
                <li><a href="customer-list.php" class="chart-nav"><i class="fa fa-users nav_icon"></i>Customer List</a></li>
                <li><a href="bwdates-reports-ds.php" class="chart-nav"><i class="fa fa-file-text-o nav_icon"></i>B/W Dates Report</a></li>
                <li><a href="sales-reports.php" class="chart-nav"><i class="fa fa-file-text-o nav_icon"></i>Sales Report</a></li>
                <li><a href="invoices.php" class="chart-nav"><i class="fa fa-file-text-o nav_icon"></i>Invoices</a></li>
                <li><a href="search-appointment.php" class="chart-nav"><i class="fa fa-search nav_icon"></i>Search Appointment</a></li>
                <li><a href="search-invoices.php" class="chart-nav"><i class="fa fa-search nav_icon"></i>Search Invoice</a></li>
            </ul>
            <div class="clearfix"> </div>
        </nav>
    </div>
</nav>

<script>
    // JavaScript to handle the collapsible menus
    document.querySelectorAll('.toggle-submenu').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const submenu = this.nextElementSibling;
            if (submenu) {
                submenu.classList.toggle('show'); // Toggle 'show' class to show/hide submenu
            }
        });
    });
</script>

</body>
</html>
