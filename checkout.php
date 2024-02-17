<?php
session_start();
include "helper/db.php";
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
if ($_POST) {
    $user_id = $_SESSION['user']['user_id'];
    $shipping_name = $_POST['first_name'] . " " . $_POST['last_name'];
    $shipping_email = $_POST['shipping_email'];
    $shipping_mobile = $_POST['shipping_mobile'];
    $shipping_address = $_POST['address1'] . ", " . $_POST['address2'] . ", " . $_POST['city'] . ", " . $_POST['state'] . " - " . $_POST['pincode'] . ", " . $_POST['country'];
    $payment_mode = $_POST['payment_mode'];


    $ordermasterq = mysqli_query($con, "INSERT INTO tbl_order_master(order_date, user_id, order_status, shipping_name, shipping_email, shipping_mobile, shipping_address,payment_mode) 
    VALUES (CURRENT_TIMESTAMP(),'$user_id','Pending','$shipping_name','$shipping_email','$shipping_mobile','$shipping_address','$payment_mode')");
    $order_id = mysqli_insert_id($con);
    $cart_q = mysqli_query($con, "SELECT tbl_product.pro_price,tbl_cart.* FROM tbl_product INNER JOIN tbl_cart ON tbl_product.pro_id = tbl_cart.pro_id WHERE user_id = '$user_id'");
    while ($cartdata = mysqli_fetch_array($cart_q)) {
        $pro_id = $cartdata['pro_id'];
        $pro_cart_qty = $cartdata['pro_cart_qty'];
        $pro_price = $cartdata['pro_price'];

        $order_detail_q = mysqli_query($con, "INSERT INTO tbl_order_detail(order_id, product_id, product_qty, product_price) VALUES ('$order_id','$pro_id','$pro_cart_qty','$pro_price')");
        $deletecart = mysqli_query($con, "DELETE FROM tbl_cart WHERE user_id = '$user_id' AND cart_id = '" . $cartdata['cart_id'] . "'");
    }
    if ($deletecart) {
        echo "<script>alert('Thanks for shopping...');window.location='index.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Checkout</title>
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
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Checkout Area Strat-->
    <form method="post">
        <div class="checkout-area pt-60 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="checkbox-form">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="country-select clearfix">
                                        <label>Country <span class="required">*</span></label>
                                        <select class="nice-select wide" name="country" required>
                                            <option data-display="India" value="India">India</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>First Name <span class="required">*</span></label>
                                        <input placeholder="First Name" type="text" name="first_name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Last Name <span class="required">*</span></label>
                                        <input placeholder="Last Name" type="text" name="last_name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input placeholder="House no., Building Name (required)" type="text" name="address1" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <input placeholder="Road name, Area, Colony (required)" type="text" name="address2" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text" placeholder="City (required)" name="city" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>State / County <span class="required">*</span></label>
                                        <input placeholder="State (required)" type="text" name="state" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input placeholder="Pincode (required)" type="text" name="pincode" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input placeholder="Email" type="email" name="shipping_email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" placeholder="Mobile" name="shipping_mobile" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">Product</th>
                                            <th class="cart-product-total">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $cart_fetch = mysqli_query($con, "SELECT tbl_product.*, tbl_cart.* FROM tbl_product INNER JOIN tbl_cart ON tbl_product.pro_id=tbl_cart.pro_id WHERE tbl_cart.user_id = '" . $_SESSION['user']['user_id'] . "'");
                                        $grandtotal = 0;
                                        if (mysqli_num_rows($cart_fetch)) {
                                            while ($row = mysqli_fetch_array($cart_fetch)) {
                                                $subtotal = $row['pro_price'] * $row['pro_cart_qty'];
                                                $grandtotal += $subtotal;
                                        ?>
                                                <tr class="cart_item">
                                                    <td class="cart-product-name"> <?= $row['pro_name'] ?><strong class="product-quantity"> × <?= $row['pro_cart_qty'] ?></strong></td>
                                                    <td class="cart-product-total"><span class="amount">₹<?= $subtotal ?></span></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        } else {
                                        ?>
                                            <tr>
                                                <td colspan="2" class="cart_item">
                                                    Cart is empty
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="order-total">
                                            <th>Grand Total</th>
                                            <td><strong><span class="amount">₹<?= $grandtotal ?></span></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title d-flex align-items-center">
                                                    <input type="radio" name="payment_mode" value="cash on delivery" style="width: 10%; height: 25px;">Cash
                                                </h5>
                                                <h5 class="panel-title d-flex align-items-center">
                                                    <input type="radio" name="payment_mode" value="netbanking" style="width: 10%; height: 25px;">Netbanking
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <input value="Place order" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--Checkout Area End-->
    <!-- Begin Footer Area -->
    <?php include "components/footer.php"; ?>
    <!-- End Footer Area -->
</body>

</html>