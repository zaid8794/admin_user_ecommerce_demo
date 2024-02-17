<?php
session_start();
include "helper/db.php";
if (isset($_SESSION['user'])) {
    header("location:index.php");
}
if ($_POST) {
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $mobile = $_POST['user_mobile'];
    $gender = $_POST['user_gender'];
    $password = $_POST['user_password'];

    $filename = $_FILES['user_photo']['name'];
    $filepath = $_FILES['user_photo']['tmp_name'];

    $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE user_email = '$email'");
    if (mysqli_num_rows($select) > 0) {
        echo "<script type='text/javascript'>alert('User Already Registered...');window.location='register.php';</script>";
    } else {
        $q = mysqli_query($con, "INSERT INTO tbl_user(user_name, user_email, user_mobile, user_gender, user_password, user_photo,role) VALUES 
        ('$name','$email','$mobile','$gender','$password','$filename','user')") or die("Error is " . mysqli_error($con));

        if ($q) {
            move_uploaded_file($filepath, "uploads/users/" . $filename);
            echo "<script type='text/javascript'>alert('User Registered Successfully...');window.location='login.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="css/fontawesome-stars.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="css/meanmenu.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="css/venobox.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/nice-select.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="css/helper.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Modernizr js -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- Begin Header Area -->
    <?php include "components/header.php"; ?>
    <!-- End Header Area -->
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Register</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Login Content Area -->
    <div class="page-section mb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12 mx-auto">
                    <form method="post" enctype="multipart/form-data">
                        <div class="login-form">
                            <h4 class="login-title">Register</h4>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Name</label>
                                    <input class="mb-0" type="text" placeholder="Name" name="user_name" required>
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Mobile</label>
                                    <input class="mb-0" type="text" placeholder="Mobile" name="user_mobile" required>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>Email Address*</label>
                                    <input class="mb-0" type="email" placeholder="Email Address" name="user_email" required>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>Gender</label>
                                    <div class="d-flex align-items-center flex-row">
                                        <input type="radio" style="height: 20px; width: 7%; margin-top:10px;" name="user_gender" value="male" required>
                                        <span for="" class="">Male</span>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" style="height: 20px; width: 7%; margin-top:10px;" name="user_gender" value="female" required>
                                        <span for="">Female</span>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" type="password" placeholder="Password" name="user_password" required>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>Photo</label>
                                    <input class="mb-0" type="file" name="user_photo" required>
                                </div>

                                <div class="col-12">
                                    <button class="register-button mt-0">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content Area End Here -->
    <!-- Begin Footer Area -->
    <?php include "components/footer.php"; ?>
    <!-- End Footer Area -->
</body>

</html>