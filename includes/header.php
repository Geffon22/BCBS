<!doctype html>
<html lang="en">
<head>
    <title>Bella Chica Beauty Studio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Welcome to Bella Chica Beauty Studio, where we offer a range of beauty services.">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css1/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-light ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="images/bella_logo.png" height="100px" width="300px"></a>
        
        <?php if (isset($_SESSION['username'])): ?>
            <button type="button" class="btn btn-custom ml-auto order-sm-start order-lg-last" disabled>Welcome, <?php echo $_SESSION['username']; ?> </button>
            <a href="logout.php" class="btn btn-danger order-sm-start order-lg-last">Logout</a>
        <?php else: ?>
            <button type="button" class="btn btn-custom ml-auto order-sm-start order-lg-last" data-toggle="modal" data-target="#loginModal">
                <img src="images/user.png" height="30px" width="30px">  Login
            </button>
        <?php endif; ?>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="service-list.php" class="nav-link">Services</a></li>
                <li class="nav-item"><a href="gallery.php" class="nav-link">Gallery</a></li>
                <li class="nav-item"><a href="appointment.php" id="appointmentLink" class="nav-link" <?php echo isset($_SESSION['username']) ? 'data-logged-in="true"' : ''; ?>>Appointment</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">About Us</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="loginForm" action="login.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div id="loginError" class="text-danger" style="display: none;">Invalid username or password</div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-center mb-0">
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#registerModal">Register</a> |
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotPasswordModal">Forgot Password?</a>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- END Login Modal -->

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registerForm" action="register.php" method="post">
                    <div class="form-group">
                        <label for="registerUsername">Username</label>
                        <input type="text" class="form-control" id="registerUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">Email</label>
                        <input type="email" class="form-control" id="registerEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Password</label>
                        <input type="password" class="form-control" id="registerPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-center mb-0">
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Login</a> |
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotPasswordModal">Forgot Password?</a>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- END Register Modal -->

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="forgotPasswordForm" action="forgot_password.php" method="post">
                    <div class="form-group">
                        <label for="forgotEmail">Enter your email</label>
                        <input type="email" class="form-control" id="forgotEmail" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-center mb-0">
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Login</a> |
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#registerModal">Register</a>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- END Forgot Password Modal -->

<!-- Not Logged In Modal -->
<div class="modal fade" id="notLoggedInModal" tabindex="-1" role="dialog" aria-labelledby="notLoggedInModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notLoggedInModalLabel">Login Required</h5>
            </div>
            <div class="modal-body">
                You need to login first before you can book an appointment.
            </div>
        </div>
    </div>
</div>
<!-- END Not Logged In Modal -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js1/main.js"></script>

<script>
    $(document).ready(function() {
        $('#appointmentLink').on('click', function(e) {
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

</body>
</html>
