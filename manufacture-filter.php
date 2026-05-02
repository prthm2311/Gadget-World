<?php
include './common/class.php';
$page_name = "Shop"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './theme-part/header-script.php';
    ?>
</head>

<body>
    <div class="page-wrapper">
        <?php
        include './theme-part/header-top.php';
        ?>
        <!-- End of Header -->

        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Page Content -->
            <div class="page-content mb-10">
                <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center mb-6" style="background-image: url(assets/images/shop/banner2.jpg); background-color: #FFC74E;">

                </div>
                <!-- End of Shop Banner -->
                <div class="container-fluid">
                    <!-- Start of Shop Content -->
                    <div class="shop-content">
                        <!-- Start of Shop Main Content -->
                        <div class="main-content">
                            <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                                <?php
                                if (isset($_GET['brand_id'])) {
                                    $products = mysqli_query($connection, "SELECT *from tbl_product_master where brand_id='{$_GET['brand_id']}' order By product_id ASC");
                                } else {
                                    echo "<script>window.location='shop.php'</script>";
                                }
                                $count = mysqli_num_rows($products);
                                if ($count > 0) {
                                    foreach ($products as $product) {
                                ?>
                                        <div class="product-wrap">
                                            <div class="product text-center">
                                                <figure class="product-media">
                                                    <a href="product-details.php?id=<?php echo $product['product_id']; ?>">
                                                        <img src="<?php echo $image_upload_path . $product['product_image']; ?>" title="<?php echo $product["product_name"]; ?>" alt="<?php echo $product["product_name"]; ?>" style="width: 202px;height: 227px;">
                                                    </a>
                                                    <div class="product-action-horizontal">
                                                        <a href="product-details.php?id=<?php echo $product['product_id']; ?>" class="btn-product-icon w-icon-cart" title="Add to cart"></a>
                                                    </div>
                                                </figure>
                                                <div class="product-details">
                                                    <h3 class="product-name">
                                                        <a href="product-details.php?id=<?php echo $product['product_id']; ?>"><?php echo $product["product_name"]; ?></a>
                                                    </h3>
                                                    <div class="product-pa-wrapper">
                                                        <div class="product-price">
                                                            <?php echo $rupee_symbol . $product["product_price"]; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "<h2 style='text-align:center'>No records Found.</h2>";
                                }
                                ?>

                            </div>
                        </div>
                        <!-- End of Shop Main Content -->


                    </div>
                    <!-- End of Shop Content -->
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->

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
    <!-- End of Sticky Footer -->

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
</body>

</html>