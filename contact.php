<?php
include './common/class.php';
$page_name = "Contact";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './theme-part/header-script.php';
    ?>
    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/styling.css">
    <style>
        .contact-form-section {
            padding: 20px 0 60px 0;
            background-color: #f8f9fa;
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }

        .contact-form h3 {
            margin-bottom: 25px;
            font-size: 24px;
            text-align: center;
            font-weight: 700;
            color: #333;
        }

        .contact-form label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 14px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #fdfdfd;
            font-size: 15px;
        }

        .contact-form textarea {
            height: 120px;
        }

        .contact-form button {
            padding: 14px 15px;
            background-color: #336699;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            display: block;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .contact-form button:hover {
            background-color: #28527a;
        }
    </style>
</head>

<body class="about-us">
    <div class="page-wrapper">
        <!-- Start of Header -->
        <?php
        include './theme-part/header-top.php';
        ?>
        <!-- End of Header -->

        <!-- Start of Main -->
        <main class="main" style="background-color: #f8f9fa; padding-bottom: 50px;">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav" style="background-color: #fff; border-bottom: 1px solid #eee; margin-bottom: 40px; padding: 15px 0;">
                <div class="container">
                    <ul class="breadcrumb" style="margin: 0; padding: 0;">
                        <li><a href="index.php" style="color: #666; text-decoration: none;">Home</a></li>
                        <li style="color: #999; margin-left: 10px;">/ Contact Us</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <section class="content-title-section mb-6">
                <h3 class="title title-center mb-3" style="font-size: 32px; font-weight: 700; color: #333; text-align: center;">Get in Touch</h3>
            </section>
            <!-- End of Contact Title Section -->

            <section class="contact-information-section mb-10">
                <div class="swiper-container swiper-theme" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 1,
                            'breakpoints': {
                                '480': {
                                    'slidesPerView': 2
                                },
                                '768': {
                                    'slidesPerView': 3
                                },
                                '992': {
                                    'slidesPerView': 4
                                }
                            }
                        }">
                    <div class="swiper-wrapper row cols-xl-4 cols-md-3 cols-sm-2 cols-1">
                        <div class="swiper-slide icon-box text-center icon-box-primary">
                            <span class="icon-box-icon icon-email">
                                <i class="w-icon-envelop-closed"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">E-mail Address</h4>
                                <p>gadgetworld@gmail.com</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box text-center icon-box-primary">
                            <span class="icon-box-icon icon-headphone">
                                <i class="w-icon-headphone"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">Helpline Number</h4>
                                <p>1234567890</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box text-center icon-box-primary">
                            <span class="icon-box-icon icon-map-marker">
                                <i class="w-icon-map-marker"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">Address</h4>
                                <p>Ahmedabad</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Start of Contact Form Section -->
            <section class="contact-form-section">
                <div class="container">
                    <div class="contact-form">
                        <h3>Contact Us</h3>
                        <form action="submit_contact.php" method="POST">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" required>

                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email" required>

                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" required>

                            <label for="message">Message</label>
                            <textarea id="message" name="message" required></textarea>

                            <button type="submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </section>
            <!-- End of Contact Form Section -->
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
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button">
        <i class="w-icon-angle-up"></i>
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35" r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
        </svg>
    </a>
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