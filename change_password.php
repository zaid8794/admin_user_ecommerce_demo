<?php
session_start();
include "helper/db.php";
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
if ($_POST) {
    $old_password = $_POST['user_old_password'];
    $new_password = $_POST['user_new_password'];
    $conf_password = $_POST['user_conf_password'];
    $user_email = $_SESSION['user']['user_email'];

    $select = mysqli_query($con, "SELECT * FROM tbl_user WHERE user_email = '$user_email'");
    $row = mysqli_fetch_array($select);
    if ($row['user_password'] == $old_password) {
        if ($new_password == $conf_password) {
            if ($old_password == $new_password) {
                echo "<script>alert('New password cannot be same as old password...');window.location='change_password.php';</script>";
            } else {
                $uq = mysqli_query($con, "UPDATE tbl_user SET user_password = '$new_password' WHERE user_email = '$user_email'");
                echo "<script>alert('Password Updated...');window.location='change_password.php';</script>";
            }
        } else {
            echo "<script>alert('New password and confirm password does not match...');window.location='change_password.php';</script>";
        }
    } else {
        echo "<script>alert('Old password does not match...');window.location='change_password.php';</script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Change Password</title>
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
    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-2">
                Old Password : <input type="password" class="form-control shadow-none" placeholder="Enter Old Password" name="user_old_password" required>
            </div>
            <div class="mb-2">
                New Password : <input type="password" class="form-control shadow-none" placeholder="Enter New Password" name="user_new_password" required>
            </div>
            <div class="mb-2">
                Confirm Password : <input type="password" class="form-control shadow-none" placeholder="Enter Confirm Password" name="user_conf_password" required>
            </div>
            <div class="mb-2">
                <input type="submit" class="btn btn-primary" value="Change Password">
            </div>
        </form>
    </div>
    <!-- Begin Footer Area -->
    <?php include "components/footer.php"; ?>
    <!-- End Footer Area -->
</body>

</html>