<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include './common/class.php';
$page_name = "Home";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './theme-part/header-script.php';
    ?>
    <style>
        /* Shorten banner height */
        .intro-section .banner {
            min-height: 400px !important;
            height: 400px !important;
        }

        .intro-section .slide-image img {
            max-height: 350px !important;
            width: auto !important;
        }

        .suggested-section {
            padding: 50px 0;
            background-color: #fff;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .view-all-btn {
            background-color: #336699;
            color: #fff;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: transform 0.2s;
        }

        .view-all-btn:hover {
            transform: scale(1.1);
            color: #fff;
        }

        .suggested-card {
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 15px;
            transition: box-shadow 0.3s;
            background: #fff;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .suggested-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .card-img-wrapper {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .card-img-wrapper img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .rating-badge {
            display: inline-block;
            background: #388e3c;
            color: #fff;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .card-name {
            font-size: 14px;
            font-weight: 500;
            color: #444;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 40px;
            line-height: 1.4;
        }

        .card-price {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .card-offer {
            font-size: 12px;
            color: #336699;
            font-weight: 600;
        }

        .hot-deal-label {
            font-size: 12px;
            color: #d32f2f;
            font-weight: 700;
            margin-top: 5px;
        }
    </style>
</head>

<body class="">
    <div class="page-wrapper">

        <?php
        include './theme-part/header-top.php';
        ?>
        <main class="main" style="background-color: #eaeded;">
            <div class="intro-section" style="background-color: #eaeded; padding: 20px 0;">
                <div class="container">
                    <div class="swiper-container swiper-theme nav-inner pg-inner animation-slider pg-xxl-hide pg-show nav-xxl-show nav-hide"
                        data-swiper-options="{
'slidesPerView': 1,
'autoplay': {
'delay': 4000,
'disableOnInteraction': false
}
}">
                        <div class="swiper-wrapper row gutter-no cols-1">
                            <div class="swiper-slide banner banner-fixed intro-slide intro-slide1"
                                style="background-image: url(assets/images/demos/demo2/slides/slide-1.jpg); background-color: #f1f0f0;">
                                <div class="container">
                                    <figure class="slide-image floating-item slide-animate" data-animation-options="{
'name': 'fadeInDownShorter', 'duration': '1s'
}" data-options="{'relativeInput':true,'clipRelativeInput':true,'invertX':true,'invertY':true}" data-child-depth="0.2">
                                        <img src="assets/images/demos/demo2/slides/phone.png" alt="phone" width="729"
                                            height="570" />
                                    </figure>
                                    <div class="banner-content text-right y-50 ml-auto">
                                        <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2 slide-animate"
                                            data-animation-options="{
'name': 'fadeInUpShorter', 'duration': '1s'
}">Deals And Promotions</h5>
                                        <h3 class="banner-title ls-25 mb-6 slide-animate" data-animation-options="{
'name': 'fadeInUpShorter', 'duration': '1s'
}">Phones <span class="text-primary">Tablets</span> and everything.
                                            You name it
                                        </h3>
                                        <a href="shop.php"
                                            class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                            data-animation-options="{
'name': 'fadeInUpShorter', 'duration': '1s'
}">
                                            Shop Now<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                    <!-- End of .banner-content -->
                                </div>
                                <!-- End of .container -->
                            </div>
                            <!-- End of .intro-slide1 -->

                            <div class="swiper-slide banner banner-fixed intro-slide intro-slide2"
                                style="background-image: url(assets/images/demos/demo2/slides/slide-2.jpg); background-color: #d9ddd9;">
                                <div class="container">
                                    <figure class="slide-image floating-item slide-animate" data-animation-options="{
'name': 'fadeInUpShorter', 'duration': '1s'
}" data-options="{'relativeInput':true,'clipRelativeInput':true,'invertX':true,'invertY':true}" data-child-depth="0.2">
                                        <img src="assets/images/demos/demo2/slides/woman.png" alt="Ski" width="865"
                                            height="732" />
                                    </figure>
                                    <div class="banner-content y-50">
                                        <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2 slide-animate"
                                            data-animation-options="{
'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.5s'
}">News And Inspiration</h5>
                                        <h3 class="banner-title ls-25 mb-2 text-uppercase lh-1 slide-animate"
                                            data-animation-options="{
'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.7s'
}">Natural Sound</h3>
                                        <div class="banner-price-info font-weight-bold text-dark ls-25 slide-animate"
                                            data-animation-options="{
'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.9s'
}">Sale up to
                                            <span class="text-primary font-weight-bolder text-uppercase ls-normal">30%
                                                Off</span>
                                        </div>
                                        <p class="font-weight-normal text-default ls-25 slide-animate"
                                            data-animation-options="{
'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '1.1s'
}">Free returns extended to 30 days after delivery</p>
                                        <a href="shop.php"
                                            class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                            data-animation-options="{
'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '1.3s'
}">
                                            Shop Now<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                    <!-- End of .banner-content -->
                                </div>
                                <!-- End of .container -->
                            </div>
                            <!-- End of .intro-slide2 -->

                            <div class="swiper-slide banner banner-fixed intro-slide intro-slide3"
                                style="background-image: url(assets/images/demos/demo2/slides/slide-3.jpg); background-color: #d0cfcb;">
                                <div class="container">
                                    <figure class="slide-image floating-item slide-animate" data-animation-options="{
'name': 'fadeInRightShorter', 'duration': '1s'
}" data-options="{'relativeInput':true,'clipRelativeInput':true,'invertX':true,'invertY':true}" data-child-depth="0.2">
                                        <img src="assets/images/demos/demo2/slides/man.png" alt="Ski" width="527"
                                            height="481" />
                                    </figure>
                                    <div class="banner-content y-50">
                                        <h5 class="banner-subtitle text-uppercase font-weight-bold slide-animate"
                                            data-animation-options="{
'name': 'fadeInRightShorter', 'duration': '1s'
}">Top Monthly Seller</h5>
                                        <h4 class="banner-title ls-25 slide-animate" data-animation-options="{
'name': 'fadeInRightShorter', 'duration': '1s'
}">Samsung 52 Inches Full HD <span class="text-primary">Smart LED</span> TV</h4>
                                        <p class="font-weight-normal text-dark slide-animate" data-animation-options="{
'name': 'fadeInRightShorter', 'duration': '1s'
}">Only until the end of this week.</p>
                                        <a href="shop.php"
                                            class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                            data-animation-options="{
'name': 'fadeInRightShorter', 'duration': '1s'
}">Shop Now<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                    <!-- End of .banner-content -->
                                </div>
                                <!-- End of .container -->
                            </div>
                            <!-- End of .intro-slide3 -->
                        </div>
                        <div class="swiper-pagination"></div>
                        <button class="swiper-button-next"></button>
                        <button class="swiper-button-prev"></button>
                    </div>
                </div>
            </div>
            <!-- End of .intro-section -->

            <!-- Suggested For You Section -->
            <section class="suggested-section" style="padding: 30px 0; background-color: #eaeded;">
                <div class="container">
                    <div
                        style="background: #fff; padding: 25px; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                        <div class="section-header"
                            style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                            <h2 class="section-title"
                                style="margin: 0; font-size: 22px; font-weight: 700; color: #282c3f;">Suggested For You
                            </h2>
                            <a href="shop.php" class="view-all-btn"
                                style="background: #336699; color: #fff; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: transform 0.2s;">
                                <i class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>

                        <div class="custom-suggested-swiper" style="position: relative; overflow: hidden;">
                            <div class="swiper-wrapper">
                                <?php
                                $suggested_products = mysqli_query($connection, "SELECT * FROM tbl_product_master ORDER BY RAND() LIMIT 12");
                                while ($prod = mysqli_fetch_array($suggested_products)) {
                                    $random_rating = number_format(4 + (mt_rand(0, 10) / 10), 1);
                                    $discounted_price = $prod['product_price'] * 0.9;
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="suggested-card"
                                            style="border: 1px solid #eee; border-radius: 8px; padding: 15px; transition: transform 0.3s, box-shadow: 0.3s; background: #fff;">
                                            <a href="product-details.php?id=<?php echo $prod['product_id']; ?>"
                                                style="text-decoration: none; color: inherit; display: block;">
                                                <div class="card-img-wrapper"
                                                    style="height: 180px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                                                    <img src="<?php echo $image_upload_path . $prod['product_image']; ?>"
                                                        alt="<?php echo htmlspecialchars($prod['product_name']); ?>"
                                                        style="max-height: 100%; object-fit: contain;">
                                                </div>
                                                <div class="rating-badge"
                                                    style="background: #388e3c; color: #fff; padding: 2px 6px; border-radius: 4px; font-size: 11px; display: inline-block; margin-bottom: 8px;">
                                                    <?php echo $random_rating; ?> ★
                                                </div>
                                                <h4 class="card-name"
                                                    style="font-size: 14px; margin: 0 0 8px; color: #333; height: 40px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                    <?php echo htmlspecialchars($prod['product_name']); ?>
                                                </h4>
                                                <div class="card-price"
                                                    style="font-weight: 700; font-size: 16px; color: #212121; margin-bottom: 4px;">
                                                    <?php echo $rupee_symbol . number_format($prod['product_price']); ?>
                                                </div>
                                                <div class="card-offer"
                                                    style="font-size: 12px; color: #336699; margin-bottom: 6px;">
                                                    <?php echo $rupee_symbol . number_format($discounted_price); ?> with
                                                    Bank offer
                                                </div>
                                                <div class="hot-deal-label"
                                                    style="font-size: 11px; color: #d32f2f; font-weight: 600; text-transform: uppercase;">
                                                    Hot Deal</div>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="suggested-pagination-custom" style="text-align: center; margin-top: 25px;">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End of Suggested For You Section -->

            <script>
                window.addEventListener('load', function () {
                    if (typeof Swiper !== 'undefined') {
                        new Swiper('.custom-suggested-swiper', {
                            spaceBetween: 20,
                            slidesPerView: 2,
                            pagination: {
                                el: '.suggested-pagination-custom',
                                clickable: true
                            },
                            breakpoints: {
                                576: { slidesPerView: 3 },
                                768: { slidesPerView: 4 },
                                992: { slidesPerView: 6 }
                            }
                        });
                    }

                    $('.suggested-card a').on('click', function (e) {
                        e.stopPropagation();
                    });
                });
            </script>


            <!-- End of Container -->
        </main>
        <!-- End of Main -->

        <!-- Start of Footer -->
        <?php
        include './theme-part/footer.php';
        ?>
        <!-- End of Footer -->
    </div>
    <!-- End of .page-wrapper -->
    <!-- Start of Sticky Footer -->
    <?php
    include './theme-part/header.php';
    ?>
    <!-- End of Sticky Footer -->

    <!-- Start of Scroll Top -->
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg
            version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
                r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
        </svg>
    </a>
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