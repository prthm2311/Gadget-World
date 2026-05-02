<?php
include './common/class.php';
$page_name = "Order Details";
if (isset($_SESSION['user_id'])) {
    if (isset($_GET['id'])) {
        $orderDetails = mysqli_query($connection, "SELECT *from tbl_order_details where `order_id`='{$_GET['id']}'");
    } else {
        header("location:shop.php");
    }
} else {
    header("location:shop.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './theme-part/header-script.php';
    ?>
    <!-- Swiper's CSS -->
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/styling.css">
</head>

<body>
    <div class="page-wrapper">
        <!-- Start of Header -->
        <?php
        include './theme-part/header-top.php';
        ?>
        <!-- End of Header -->


        <!-- Start of Main -->
        <main class="main mb-10 pb-1">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav container">
                <ul class="breadcrumb bb-no">
                    <li><a href="my-account.php">Dashboard</a></li>
                    <li>Order Details</li>
                </ul>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg">
                        <div class="">
                            <div class="product product-single row">
                                <div class="col-md-12 mb-4">
                                    <table class="table table-bordered" style="font-size: 15px;">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>product Id</th>
                                            <th>Qty</th>
                                            <th>Total Amount</th>
                                        </tr>
                                        <?php
                                        $i = 1;
                                        foreach ($orderDetails as $getData) {
                                            $product = mysqli_query($connection, "SELECT * FROM `tbl_product_master` WHERE `product_id`='{$getData['product_id']}'");
                                            $productDetails = mysqli_fetch_assoc($product);
                                        ?>
                                            <tr>
                                                <th><?php echo  $i++; ?></th>
                                                <th><?php echo $productDetails['product_name'] ?></th>
                                                <th><?php echo $getData['product_id']; ?></th>
                                                <th><?php echo $getData['product_qty']; ?></th>
                                                <th>Rs.<?php echo $getData['total_amount']; ?></th>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                    <!-- <div class="text-center">
                                        <h5><a href="print.php">Print</a></h5>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->

        <!-- Start of Footer -->
        <?php
        include './theme-part/footer.php';
        ?>
        <!-- End of Footer -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Start of Sticky Footer -->
    <?php
    include './theme-part/header.php';
    ?>
    <!-- Start of Scroll Top -->
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35" r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
        </svg> </a>
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
    <?php
    include './theme-part/mobile-menu.php';
    ?>
    <!-- End of Mobile Menu -->



    <?php
    include './theme-part/footer-script.php';
    ?>

    <!-- Swiper JS -->
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.min.js"></script>
</body>

</html>