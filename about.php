<?php
include './common/class.php';
$page_name = "About";
?>

<!-- HTML starts here -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './theme-part/header-script.php';
    ?>
    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/styling.css">
</head>

<body class="about-us">
    <div class="page-wrapper">
        <!-- Start of Header -->
        <?php
        include './theme-part/header-top.php';
        ?>
        <!-- End of Header -->

        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">About Us</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav mb-10 pb-8">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">
                    <section class="introduce mb-10 pb-10">
                        <h2 class="title title-center">
                            We’re Devoted To Deliver Best Quality Products.<br>We Help Your Business Grow
                        </h2>
                        <figure class="br-lg">
                            <img src="assets/images/pages/about_us/1.jpg" alt="Banner" width="1240" height="540" style="background-color: #D0C1AE;" />
                        </figure>
                        <p>
                        Welcome to Gadget world, your one-stop destination for all your shopping needs! We offer a wide range of high-quality products, from the latest electronics and gadgets to fashionable apparel, beauty products, home essentials, and much more. Whether you're looking for cutting-edge tech, stylish clothing, or everyday household items, we've got you covered.
                        <br>
                        Our dedicated team of employees works tirelessly to ensure that every product meets the highest standards of quality. We carefully curate our selection to bring you only the best items, and our commitment to excellence extends beyond our products. From the moment you place your order to the time it arrives at your doorstep, we take great care to ensure a smooth and satisfying shopping experience.
                        </p>
                    </section>

                 
                </div>


            </div>
        </main>
        <!-- End of Main -->

        <!-- Start of Footer -->
        <?php
        include './theme-part/footer.php';
        ?>
        <!-- End of Footer -->
    </div>

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

    <!-- Plugin JS File -->
    <?php
    include './theme-part/footer-script.php';
    ?>
    <script src="assets/vendor/jquery.count-to/jquery.count-to.min.js"></script>
</body>

</html>