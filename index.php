<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
ob_start() ;
session_start();
include_once("admin/connect.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/category.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/success.css">
    <link type="text/css" href="css/carts.css" rel="stylesheet" media="screen">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>

    <!--	Header	-->
    <div id="header">
        <div class="container">
            <div class="row">
                <?php
                // logo
                include_once("module/logo/logo.php");

                //search
                include_once("module/search/search_box.php");

                //cart
                include_once("module/cart/cart_notify.php");

                ?>


            </div>
        </div>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <!--	End Header	-->

    <!--	Body	-->
    <div id="body">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php
                    // menu
                    include_once("module/menu/menu.php");

                    ?>
                </div>
            </div>
            <div class="row">
                <div id="main" class="col-lg-8 col-md-12 col-sm-12">

                    <?php

                    // slide
                    include_once("module/slide/slide.php");

                    // master page
                    if (isset($_GET["page_layout"])) {
                        switch ($_GET["page_layout"]) {
                            case 'cart':
                                include_once("module/cart/cart.php");
                                break;
                            case 'category':
                                include_once("module/menu/category.php");
                                break;
                            case 'product':
                                include_once("module/product/product.php");
                                break;
                            case 'search':
                                include_once("module/search/search.php");
                                break;
                            case 'success':
                                include_once("module/cart/success.php");
                                break;
                        }
                    } else {

                        include_once("module/product/feature.php");
                        include_once("module/product/latest.php");
                    }

                    ?>


                </div>

                <div id="sidebar" class="col-lg-4 col-md-12 col-sm-12">
                    <?php
                    // banner
                    include_once("module/banner/banner.php");
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!--	End Body	-->

    <div id="footer-top">
        <div class="container">
            <div class="row">
                <?php
                //logo footer
                include_once("module/footer/logo_footer.php");

                //address
                include_once("module/address/address.php");

                // services
                include_once("module/services/services.php");

                // hot line
                include_once("module/hotline/hotline.php");
                ?>



            </div>
        </div>
    </div>

</body>

</html>