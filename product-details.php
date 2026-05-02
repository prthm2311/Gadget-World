<?php
include './common/class.php';
if (isset($_GET['id'])) {
    $product = mysqli_query($connection, "SELECT *from tbl_product_master where product_id='{$_GET['id']}'");
    $productDetails = mysqli_fetch_assoc($product);
    $seller = mysqli_query($connection, "SELECT *from tbl_seller");
    $sellerDetails = mysqli_fetch_all($seller);
    $page_name = "{$productDetails['product_name']}";
    $category = mysqli_query($connection, "SELECT *from tbl_category where category_id='{$productDetails['category_id']}'");
    $categoryDetails = mysqli_fetch_assoc($category);
    $brand = mysqli_query($connection, "SELECT *from tbl_brand where brand_id='{$productDetails['brand_id']}'");
    $brandDetails = mysqli_fetch_assoc($brand);
    $feedback = mysqli_query($connection, "SELECT *from tbl_feedback where product_id='{$productDetails['product_id']}'");
    $feedbackCount = mysqli_num_rows($feedback);
    $feedbackDetails = mysqli_fetch_all($feedback);
} else {
    header("location:shop.php");
        exit();
}
if (isset($_SESSION['user_id'])) {
    $titleCartButton = "Add to Cart";
    $titleFeedBackButton = "Submit Review";
    $disable = "";
} else {
    $titleCartButton = "Please Login First";
    $titleFeedBackButton = "Please Login First";
    $disable = "onclick=\"window.location.href='login.php'; return false;\"";
}
if (isset($_POST['rating'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>window.location='login.php';</script>";
        exit;
    }
    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['id'];
    $seller_id = $_POST['seller_id'];
    $feedback_date = date('Y-m-d');
    $feedback_rating = $_POST['feedback_rating'];
    $feedback_message = $_POST['feedback_message'];
    $feedback_subject = $_POST['feedback_subject'];
    $find = mysqli_query($connection, "SELECT *from tbl_feedback where `user_id`='{$user_id}' and `product_id`='{$product_id}'");
    $findCount = mysqli_num_rows($find);
    if ($findCount > 0) {
        $insert = mysqli_query($connection, "UPDATE `tbl_feedback` SET `user_id`='{$user_id}',`product_id`='$product_id',`seller_id`='{$seller_id}',`feedback_date`='{$feedback_date}',`feedback_subject`='{$feedback_subject}',`feedback_rating`='{$feedback_rating}',`feedback_message`='{$feedback_message}' WHERE `user_id`='{$user_id}' and `product_id`='{$product_id}'");
    } else {
        $insert = mysqli_query($connection, "INSERT INTO `tbl_feedback`(`user_id`, `product_id`, `seller_id`, `feedback_date`, `feedback_rating`, `feedback_message`,`feedback_subject`) VALUES ('{$user_id}', '{$product_id}', '{$seller_id}', '{$feedback_date}','{$feedback_rating}', '{$feedback_message}','{$feedback_subject}')");
    }
    if ($insert) {
        echo "<script>window.location='product-details.php?id={$_GET['id']}&msg=feedback_success';</script>";
    } else {
        echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Something went wrong. Please try again later.','error');});</script>";
    }
}
if (isset($_POST['delete_review'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>window.location='login.php';</script>";
        exit;
    }
    $delete_id = $_POST['delete_feedback_id'];
    $user_id = $_SESSION['user_id'];
    $delete = mysqli_query($connection, "DELETE FROM `tbl_feedback` WHERE `feedback_id`='{$delete_id}' AND `user_id`='{$user_id}'");
    if ($delete) {
        echo "<script>window.location='product-details.php?id={$_GET['id']}&msg=feedback_deleted';</script>";
    } else {
        echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Something went wrong. Please try again later.','error');});</script>";
    }
}
if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>window.location='login.php';</script>";
        exit;
    }
    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['id'];
    $seller_id = $_POST['seller_id'];
    $product_qty = intval($_POST['bulk_qty']);
    if ($product_qty < 1) $product_qty = 1;
    if ($product_qty <= $_POST['product_quantity']) {
        $find = mysqli_query($connection, "SELECT *from tbl_cart where `user_id`='{$user_id}' and `product_id`='{$product_id}'");
        $findCount = mysqli_num_rows($find);
        if ($findCount > 0) {
            $insert = mysqli_query($connection, "UPDATE `tbl_cart` SET `user_id`='{$user_id}',`product_id`='$product_id',`seller_id`='{$seller_id}',`product_qty`='{$product_qty}' WHERE `user_id`='{$user_id}' and `product_id`='{$product_id}'");
        } else {
            $insert = mysqli_query($connection, "INSERT INTO `tbl_cart`(`user_id`, `seller_id`, `product_id`, `product_qty`) VALUES ('{$user_id}', '{$seller_id}', '{$product_id}', '{$product_qty}')");
        }
        if ($insert) {
            echo "<script>window.location='product-details.php?id={$_GET['id']}&msg=cart_success';</script>";
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Something went wrong. Please try again later.','error');});</script>";
        }
    } else {
        echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Product out of stock or quantity exceeds available stock.','error');});</script>";
    }
}

if (isset($_POST['sample'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>window.location='login.php';</script>";
        exit;
    }
    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['id'];
    $seller_id = $_POST['seller_id'];
    $product_qty = 1;
    if ($_POST['product_quantity'] > 0) {
        $find = mysqli_query($connection, "SELECT *from tbl_cart where `user_id`='{$user_id}' and `product_id`='{$product_id}'");
        $findCount = mysqli_num_rows($find);
        if ($findCount > 0) {
            $insert = mysqli_query($connection, "UPDATE `tbl_cart` SET `user_id`='{$user_id}',`product_id`='$product_id',`seller_id`='{$seller_id}',`product_qty`='{$product_qty}' WHERE `user_id`='{$user_id}' and `product_id`='{$product_id}'");
        } else {
            $insert = mysqli_query($connection, "INSERT INTO `tbl_cart`(`user_id`, `seller_id`, `product_id`, `product_qty`) VALUES ('{$user_id}', '{$seller_id}', '{$product_id}', '{$product_qty}')");
        }
        if ($insert) {
            echo "<script>window.location='product-details.php?id={$_GET['id']}&msg=cart_success';</script>";
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Something went wrong. Please try again later.','error');});</script>";
        }
    } else {
        echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Product is out of stock.','error');});</script>";
    }
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
        <!-- Start of Main -->
        <main class="main" style="background-color: #eaeded; padding-bottom: 40px;">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav" style="background: transparent; padding: 15px 0;">
                <div class="container">
                    <ul class="breadcrumb bb-no" style="padding: 0; margin: 0; font-size: 13px; color: #666;">
                        <li><a href="index.php" style="color: #336699;">Home</a></li>
                        <li style="margin: 0 8px;">/</li>
                        <li style="color: #333; font-weight: 500;"><?php echo $productDetails['product_name'] ?></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">
                    <div style="background: #fff; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 30px; margin-bottom: 30px;">
                        <div class="product product-single row">
                            <div class="col-md-5 mb-6">
                                <div class="product-gallery" style="border: 1px solid #eee; border-radius: 8px; padding: 20px; background: #fff;">
                                    <div class="swiper-container product-single-swiper">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <figure class="product-image" style="margin: 0; display: flex; align-items: center; justify-content: center; height: 400px;">
                                                    <img src="<?php echo $image_upload_path . $productDetails['product_image']; ?>" 
                                                         alt="<?php echo htmlspecialchars($productDetails['product_name']); ?>" 
                                                         style="max-height: 100%; width: auto; object-fit: contain;">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 mb-4">
                                <div class="product-details" style="padding-left: 20px;">
                                    <div style="margin-bottom: 15px; display: flex; gap: 10px; flex-wrap: wrap;">
                                        <span style="background: #e3f2fd; color: #336699; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
                                            <?php echo $categoryDetails['category_name']; ?>
                                        </span>
                                        <?php if ($productDetails['product_quantity'] > 0): ?>
                                            <span style="background: #e8f5e9; color: #2e7d32; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
                                                In Stock (<?php echo $productDetails['product_quantity']; ?>)
                                            </span>
                                        <?php else: ?>
                                            <span style="background: #ffebee; color: #c62828; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
                                                Out of Stock
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <h1 class="product-title" style="font-size: 28px; font-weight: 700; color: #212121; margin-bottom: 10px; line-height: 1.2;">
                                        <?php echo htmlspecialchars($productDetails['product_name']); ?>
                                    </h1>

                                    <div class="ratings-container" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                                        <div style="color: #fb8c00; font-size: 16px;">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <span style="color: #336699; font-size: 14px; font-weight: 500;"><?php echo $feedbackCount; ?> Verified Reviews</span>
                                    </div>

                                    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

                                    <div class="product-price" style="margin-bottom: 15px;">
                                        <span style="font-size: 32px; font-weight: 700; color: #212121;"><?php echo $rupee_symbol . number_format($productDetails["product_price"]); ?></span>
                                        <span style="font-size: 14px; color: #666; margin-left: 10px; text-decoration: line-through;"><?php echo $rupee_symbol . number_format($productDetails["product_price"] * 1.2); ?></span>
                                        <span style="font-size: 14px; color: #388e3c; font-weight: 600; margin-left: 10px;">(20% OFF)</span>
                                    </div>

                                    <div class="product-short-desc" style="font-size: 16px; color: #424242; line-height: 1.6; margin-bottom: 30px;">
                                        <?php echo $productDetails["product_details"]; ?>
                                    </div>

                                    <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #f0f0f0; margin-bottom: 30px;">
                                        <h5 style="margin: 0 0 10px; font-size: 13px; color: #666; text-transform: uppercase; letter-spacing: 0.5px;">Offers & Coupons</h5>
                                        <div style="display: flex; align-items: center; gap: 10px; color: #333; font-size: 14px;">
                                            <i class="fas fa-tag" style="color: #336699;"></i>
                                            <span>Get 10% instant discount on Bank Cards</span>
                                        </div>
                                    </div>

                                    <form method="POST">
                                        <input type="hidden" name="product_quantity" value="<?php echo $productDetails['product_quantity']; ?>">
                                        <input type="hidden" name="seller_id" value="1">
                                        
                                        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                                            <button class="btn btn-primary <?php echo $disable ?>" type="submit" name="sample" 
                                                    style="flex: 2; height: 50px; background: #336699; border: none; border-radius: 6px; font-weight: 700; font-size: 16px; display: flex; align-items: center; justify-content: center; gap: 10px; transition: background 0.3s;">
                                                <i class="w-icon-cart" style="font-size: 20px;"></i>
                                                <span><?php echo $titleCartButton ?></span>
                                            </button>

                                            <button class="btn btn-dark <?php echo $disable ?>" type="submit" name="add_to_cart"
                                                    style="flex: 2; height: 50px; background: #336699; border: none; border-radius: 6px; font-weight: 700; font-size: 16px; display: flex; align-items: center; justify-content: center; gap: 10px; transition: background 0.3s; color: #fff;">
                                                <i class="fas fa-bolt"></i>
                                                <span>Buy in Bulk</span>
                                            </button>

                                            <div style="display: flex; align-items: center; border: 1px solid #ddd; border-radius: 6px; overflow: hidden; background: #fff; height: 50px; flex: 1; min-width: 120px;">
                                                <button type="button" onclick="this.parentNode.querySelector('input').stepDown()" style="background: none; border: none; padding: 0 10px; cursor: pointer; color: #333;"><i class="fas fa-minus"></i></button>
                                                <input type="number" name="bulk_qty" value="10" min="10" max="<?php echo $productDetails['product_quantity']; ?>" 
                                                       style="width: 40px; border: none; text-align: center; font-weight: 600; font-size: 16px; border-left: 1px solid #ddd; border-right: 1px solid #ddd; height: 100%; outline: none;">
                                                <button type="button" onclick="this.parentNode.querySelector('input').stepUp()" style="background: none; border: none; padding: 0 10px; cursor: pointer; color: #333;"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </form>

                                    <div style="margin-top: 25px; display: flex; gap: 20px;">
                                        <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #666;">
                                            <i class="fas fa-truck" style="color: #336699;"></i>
                                            <span>Free Delivery</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #666;">
                                            <i class="fas fa-undo" style="color: #336699;"></i>
                                            <span>7 Days Replacement</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #666;">
                                            <i class="fas fa-shield-alt" style="color: #336699;"></i>
                                            <span>1 Year Warranty</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab tab-nav-boxed tab-nav-underline product-tabs" style="margin-top: 40px;">
                            <ul class="nav nav-tabs" role="tablist" style="border-bottom: 2px solid #f0f0f0; margin-bottom: 30px;">
                                <li class="nav-item">
                                    <a href="#product-tab-description" class="nav-link active" style="font-size: 16px; font-weight: 600; padding: 10px 20px; border: none; background: none; transition: 0.3s;">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#feedback-tab-description" class="nav-link" style="font-size: 16px; font-weight: 600; padding: 10px 20px; border: none; background: none; transition: 0.3s;">Reviews (<?php echo $feedbackCount ?>)</a>
                                </li>
                            </ul>
                            <div class="tab-content" style="padding: 0;">
                                <div class="tab-pane active" id="product-tab-description">
                                    <div style="font-size: 15px; color: #424242; line-height: 1.8;">
                                        <h4 style="font-size: 18px; font-weight: 700; color: #212121; margin-bottom: 15px;">Product Specification</h4>
                                        <?php echo $productDetails["product_details"]; ?>
                                    </div>
                                </div>
                                <div class="tab-pane" id="feedback-tab-description">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div style="background: #f9f9f9; padding: 25px; border-radius: 8px; border: 1px solid #eee;">
                                                <h3 style="font-size: 20px; font-weight: 700; color: #212121; margin-bottom: 20px;">Submit Your Review</h3>
                                                <form method="POST" class="review-form">
                                                    <input type="hidden" name="seller_id" value="1">
                                                    <div style="margin-bottom: 15px;">
                                                        <label style="display: block; font-size: 13px; font-weight: 600; color: #666; margin-bottom: 5px;">Subject</label>
                                                        <input type="text" name="feedback_subject" id="feedback_subject" class="form-control" placeholder="Summarize your experience" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                                    </div>
                                                    <div style="margin-bottom: 15px;">
                                                        <label style="display: block; font-size: 13px; font-weight: 600; color: #666; margin-bottom: 5px;">Rating</label>
                                                        <select name="feedback_rating" id="feedback_rating" required class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                                            <option value="5">Perfect (5 Stars)</option>
                                                            <option value="4">Good (4 Stars)</option>
                                                            <option value="3">Average (3 Stars)</option>
                                                            <option value="2">Poor (2 Stars)</option>
                                                            <option value="1">Terrible (1 Star)</option>
                                                        </select>
                                                    </div>
                                                    <div style="margin-bottom: 20px;">
                                                        <label style="display: block; font-size: 13px; font-weight: 600; color: #666; margin-bottom: 5px;">Comment</label>
                                                        <textarea cols="30" rows="5" placeholder="Tell us what you liked or disliked" class="form-control" id="feedback_message" name="feedback_message" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; resize: none;"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary <?php echo $disable ?>" name="rating" style="width: 100%; height: 45px; background: #336699; border: none; border-radius: 4px; font-weight: 700; color: #fff;">
                                                        <?php echo $titleFeedBackButton ?>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>>
                                                        <?php
                                                        if ($feedbackCount > 0) {
                                                        ?>
                                                            <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                                                <div class="tab-content">
                                                                    <div class="tab-pane active" id="show-all">
                                                                        <ul class="comments list-style-none">
                                                                            <?php
                                                                            foreach ($feedbackDetails as $feedbackDetail) {
                                                                                $user = mysqli_query($connection, "SELECT *from tbl_user_master where `user_id`='{$feedbackDetail[1]}'");
                                                                                $fetchUser = mysqli_fetch_assoc($user);
                                                                            ?>
                                                                                <li class="comment">
                                                                                    <div class="comment-body">
                                                                                        <figure class="comment-avatar" style="width: 90px; height: 90px; background-color: #ddd; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                                                                            <i class="fas fa-user" style="font-size: 50px; color: #fff; margin-top: 15px;"></i>
                                                                                        </figure>
                                                                                        <div class="comment-content">
                                                                                            <h4 class="comment-author">
                                                                                                <a href="#"><?php echo $fetchUser['user_first_name'] . ' ' . $fetchUser['user_last_name']; ?></a>
                                                                                                <span class="comment-date"><?php echo $feedbackDetail[4] ?></span>
                                                                                            </h4>
                                                                                            <div class="ratings-container comment-rating">
                                                                                                <?php
                                                                                                for ($i = 1; $i <= 5; $i++) {
                                                                                                    if ($feedbackDetail[6] >= $i) {
                                                                                                        $styleStar = "style='color: #F29934;'";
                                                                                                    } else {
                                                                                                        $styleStar = "";
                                                                                                    }
                                                                                                ?>
                                                                                                    <i class="fas fa-star" <?php echo $styleStar ?>></i>
                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                            </div>
                                                                                            <p><?php echo $feedbackDetail[7] ?></p>
                                                                                            <?php if (isset($_SESSION['user_id']) && $feedbackDetail[1] == $_SESSION['user_id']) { ?>
                                                                                                <div style="margin-top: 10px; display: flex; gap: 15px; align-items: center;">
                                                                                                    <a href="javascript:void(0);" onclick="editReview('<?php echo $feedbackDetail[6]; ?>', '<?php echo htmlspecialchars(addslashes($feedbackDetail[7])); ?>')" style="font-size: 12px; color: #336699; font-weight: 600; text-decoration: none;"><i class="fas fa-edit"></i> Edit</a>
                                                                                                    <form method="POST" style="margin: 0;">
                                                                                                        <input type="hidden" name="delete_feedback_id" value="<?php echo $feedbackDetail[0]; ?>">
                                                                                                        <button type="submit" name="delete_review" onclick="return confirm('Are you sure you want to delete this review?');" style="background: none; border: none; padding: 0; font-size: 12px; color: #dc3545; font-weight: 600; cursor: pointer;"><i class="fas fa-trash-alt"></i> Delete</button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                                                <div class="tab-content">
                                                                    <div class="tab-pane active" id="show-all">
                                                                        <h3 class="title tab-pane-title font-weight-bold mb-1">(<?php echo $feedbackCount ?>) Customer Reviews</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

    <script>
    function editReview(rating, message) {
        document.getElementById('feedback_rating').value = rating;
        document.getElementById('feedback_message').value = message;
        // The form action already does an UPDATE if the user has an existing review, so we just populate it
        document.getElementById('feedback_message').focus();
        document.querySelector('.review-form').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    </script>

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
