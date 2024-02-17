<?php
session_start();
include "helper/db.php";

if (isset($_GET['sub_cat_id'])) {
    $sub_cat_id = $_GET['sub_cat_id'];
    $pro_select = mysqli_query($con, "SELECT * FROM tbl_product WHERE sub_cat_id = '$sub_cat_id'");
} else if (isset($_GET['pro_search'])) {
    $search_keyword = $_GET['pro_search'];
    $pro_select = mysqli_query($con, "SELECT * FROM tbl_product WHERE pro_name LIKE '%$search_keyword%'");
} else {
    $pro_select = mysqli_query($con, "SELECT * FROM tbl_product");
}
$sub_cat_select = mysqli_query($con, "SELECT * FROM tbl_sub_category");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shop</title>
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
                    <li class="active">Shop</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Li's Content Wraper Area -->
    <div class="content-wraper pt-60 pb-60 pt-sm-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-1 order-lg-2">
                    <!-- shop-top-bar start -->
                    <div class="shop-top-bar mt-30">
                        <div class="shop-bar-inner d-flex align-items-center">
                            <div class="toolbar-amount">
                                <span>Showing <?= mysqli_num_rows($pro_select) ?> product</span>
                            </div>
                            <div class="toolbar-amount" style="margin-left: 450px;">
                                <form method="get">
                                    <input type="search" placeholder="Search" class="form-control shadow-none" name="pro_search" id="">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- shop-top-bar end -->
                    <!-- shop-products-wrapper start -->
                    <div class="shop-products-wrapper">
                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                <div class="product-area shop-product-area">
                                    <div class="row">
                                        <?php
                                        while ($row = mysqli_fetch_array($pro_select)) {
                                        ?>
                                            <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                                <!-- single-product-wrap start -->
                                                <div class="single-product-wrap">
                                                    <div class="product-image text-center">
                                                        <a href="product_detail.php?pro_id=<?= $row['pro_id'] ?>">
                                                            <img src="uploads/products/<?= $row['pro_image'] ?>" alt="Li's Product Image" width="">
                                                        </a>
                                                    </div>
                                                    <div class="product_desc">
                                                        <div class="product_desc_info">
                                                            <div class="product-review">
                                                                <h5 class="manufacturer">
                                                                    <?php
                                                                    $subcat_select = mysqli_query($con, "SELECT * FROM tbl_sub_category WHERE sub_cat_id='" . $row['sub_cat_id'] . "'");
                                                                    $subcat_row = mysqli_fetch_array($subcat_select);
                                                                    ?>
                                                                    <a><?= $subcat_row['sub_cat_name'] ?></a>
                                                                </h5>
                                                            </div>
                                                            <h4><a class="product_name" href="product_detail.php?pro_id=<?= $row['pro_id'] ?>"><?= $row['pro_name'] ?></a></h4>
                                                            <div class="price-box">
                                                                <span class="new-price">₹<?= $row['pro_price'] ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- single-product-wrap end -->
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shop-products-wrapper end -->
                </div>
                <div class="col-lg-3 order-2 order-lg-1">
                    <!--sidebar-categores-box start  -->
                    <div class="sidebar-categores-box">
                        <div class="sidebar-title">
                            <h2>Filter By</h2>
                        </div>
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Categories</h5>
                            <div class="categori-checkbox">
                                <ul>
                                    <li><i class="fa fa-arrow-right" style="color: #e80f0f;"></i><a href="shop.php">All</a></li>
                                    <?php
                                    while ($sub_cat_row = mysqli_fetch_array($sub_cat_select)) {
                                    ?>
                                        <li><i class="fa fa-arrow-right" style="color: #e80f0f;"></i><a href="shop.php?sub_cat_id=<?= $sub_cat_row['sub_cat_id'] ?>"><?= $sub_cat_row['sub_cat_name'] ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                    </div>
                    <!--sidebar-categores-box end  -->
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wraper Area End Here -->
    <!-- Begin Footer Area -->
    <?php include "components/footer.php"; ?>
    <!-- End Footer Area -->
</body>

</html>