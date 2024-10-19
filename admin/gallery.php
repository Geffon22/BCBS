<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']==0)) {
    header('location:logout.php');
    exit;
}

if(isset($_POST['submit'])) {
    $category = $_POST['category'];

    foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['image']['name'][$key];
        $file_tmp = $_FILES['image']['tmp_name'][$key];
        $file_type = $_FILES['image']['type'][$key];

        if($file_type != "image/jpg" && $file_type != "image/jpeg" && $file_type != "image/png" && $file_type != "image/gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        } else {
            $target_path = "uploads/" . $file_name;
            if(move_uploaded_file($file_tmp, $target_path)) {
                $query = "INSERT INTO tblgallery (ImagePath, ImageCategory) VALUES ('$target_path', '$category')";
                $result = mysqli_query($con, $query);
                if(!$result) {
                    echo "Error uploading image. Please try again.";
                }
            } else {
                echo "Error moving uploaded file.";
            }
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>BCBS | Gallery</title>
    <!-- Stylesheets and scripts -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Manage Gallery</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
                        <div class="form-title">
                            <h4>Upload Image:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" enctype="multipart/form-data" action="">
                                <div class="form-group">
                                    <label for="image">Choose Image:</label>
                                    <input type="file" class="form-control" name="image[]" multiple required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Select Category:</label>
                                    <select class="form-control" name="category" required>
                                        <?php
                                        $categories_query = mysqli_query($con, "SELECT * FROM tblcategories");
                                        while ($category_row = mysqli_fetch_assoc($categories_query)) {
                                            echo "<option value='".$category_row['CategoryID']."'>".$category_row['CategoryName']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-default">Upload</button>
                            </form>
                        </div>
                    </div>

                    <h3 class="title1 mt-5">Gallery</h3>
                    <div class="form-group">
                        <label for="filterCategory">Filter by Category:</label>
                        <select class="form-control" id="filterCategory">
                            <option value="all">All</option>
                            <?php
                            $categories_query = mysqli_query($con, "SELECT * FROM tblcategories");
                            while ($category_row = mysqli_fetch_assoc($categories_query)) {
                                echo "<option value='".$category_row['CategoryID']."'>".$category_row['CategoryName']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="row" id="gallery">
                        <?php
                        $ret = mysqli_query($con, "SELECT * FROM tblgallery");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                            <div class="col-md-3 mb-4 gallery-item" data-category="<?php echo $row['ImageCategory']; ?>">
                                <img src="<?php echo $row['ImagePath']; ?>" alt="<?php echo $row['ImageName']; ?>" class="img-thumbnail">
                                <button class="btn btn-danger mt-2" onclick="deleteImage(<?php echo $row['ID']; ?>)">Delete</button>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php include_once('includes/footer.php');?>
        </div>
    </div>
    
    <script>
        function deleteImage(imageId) {
            if (confirm("Are you sure you want to delete this image?")) {
                $.ajax({
                    url: 'delete_image.php',
                    type: 'POST',
                    data: { id: imageId },
                    success: function(response) {
                        if (response == 'success') {
                            alert('Image deleted successfully.');
                            location.reload();
                        } else {
                            alert('Error deleting image. Please try again.');
                        }
                    },
                    error: function() {
                        alert('Error deleting image. Please try again.');
                    }
                });
            }
        }

        $('#filterCategory').change(function() {
            var category = $(this).val();
            if (category == 'all') {
                $('.gallery-item').show();
            } else {
                $('.gallery-item').hide();
                $('.gallery-item[data-category="' + category + '"]').show();
            }
        });
    </script>
</body>
</html>
