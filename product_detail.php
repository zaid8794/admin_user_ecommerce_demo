<?php
session_start();
include "helper/db.php";

if (isset($_GET['pro_id'])) {
    $pro_id = $_GET['pro_id'];
    $pro_select = mysqli_query($con, "SELECT * FROM tbl_product WHERE pro_id = '$pro_id'");
    $row = mysqli_fetch_array($pro_select);
}else {
    header("Location:shop.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $row['pro_name'] ?></title>
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
                    <li><a href="shop.php">Shop</a></li>
                    <li class="active"><?= $row['pro_name'] ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <div class="container">
        <div class="row p-5">
            <div class="col-6">
                <div class="text-center">
                    <img src="uploads/products/<?= $row['pro_image'] ?>" alt="" class="img-thumbnail">
                </div>
            </div>
            <div class="col-6">
                <div>
                    <h4><?= strtoupper($row['pro_name']) ?></h4>
                    <h5 class="text-primary mt-3">₹<?= $row['pro_price'] ?>&nbsp;&nbsp;<del class="text-danger">₹<?= round(($row['pro_price'] * 5 / 100) + $row['pro_price']) ?></del></h5>
                    <form action="cart_process.php" method="post">
                        <input type="hidden" name="pro_id" value="<?= $row['pro_id'] ?>">
                        <label for="">Qty :</label>
                        <select name="pro_qty" class="form-control shadow-none w-50">
                            <?php
                            for ($i = 1; $i <= 10; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="pro_id" value="<?= $_GET['pro_id'] ?>">
                        <button type="submit" name="addtocart" class="btn btn-success shadow-none mt-3">Add to Cart</button>
                    </form>
                    <p class="mt-4"><?= $row['pro_details'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Begin Footer Area -->
    <?php include "components/footer.php"; ?>
    <!-- End Footer Area -->
</body>

</html>