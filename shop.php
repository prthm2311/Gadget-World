<?php
include './common/class.php';
$page_name = "Shop";

if (isset($_POST['sample']) || isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>window.location='login.php';</script>";
        exit;
    } else {
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $seller_id = $_POST['seller_id'];
        $available_qty = $_POST['product_quantity'];
        
        $product_qty = isset($_POST['add_to_cart']) ? intval($_POST['bulk_qty']) : 1;
        if ($product_qty < 1) $product_qty = 1;
        
        if ($available_qty > 0 && $product_qty <= $available_qty) {
            $find = mysqli_query($connection, "SELECT * from tbl_cart where `user_id`='{$user_id}' and `product_id`='{$product_id}'");
            if (mysqli_num_rows($find) > 0) {
                $insert = mysqli_query($connection, "UPDATE `tbl_cart` SET `product_qty`='{$product_qty}', `seller_id`='{$seller_id}' WHERE `user_id`='{$user_id}' and `product_id`='{$product_id}'");
            } else {
                $insert = mysqli_query($connection, "INSERT INTO `tbl_cart`(`user_id`, `seller_id`, `product_id`, `product_qty`) VALUES ('{$user_id}', '{$seller_id}', '{$product_id}', '{$product_qty}')");
            }
            if ($insert) {
                echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Added to cart successfully.','success');});</script>";
            } else {
                echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Something went wrong. Please try again later.','error');});</script>";
            }
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Product out of stock or quantity exceeds available stock.','error');});</script>";
        }
    }
}
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
        <main class="main" style="background-color: #f1f3f6; padding-bottom: 40px; padding-top: 20px;">
            <!-- Start of Page Content -->
            <div class="page-content mb-10">
                <!-- Banner removed -->
                <div class="container">
                    <!-- Start of Shop Content -->
                    <div class="shop-content">
                        <!-- Start of Shop Main Content -->
                        <div class="main-content">
                            <div class="product-wrapper list-view" style="display: block;">
                                <?php
                                if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
                                    $search_term = mysqli_real_escape_string($connection, trim($_GET['search']));
                                    // Improved search logic with relevance ranking
                                    $query = "SELECT p.*, 
                                        (CASE 
                                            WHEN p.product_name = '{$search_term}' THEN 100
                                            WHEN p.product_name LIKE '{$search_term} %' THEN 95
                                            WHEN p.product_name LIKE '% {$search_term} %' THEN 90
                                            WHEN p.product_name LIKE '% {$search_term}' THEN 85
                                            WHEN c.category_name = '{$search_term}' THEN 80
                                            WHEN p.product_name LIKE '{$search_term}%' THEN 70
                                            WHEN c.category_name LIKE '{$search_term}%' THEN 60
                                            WHEN p.product_details LIKE '% {$search_term} %' THEN 50
                                            ELSE 10 
                                        END) AS relevance 
                                        FROM tbl_product_master p 
                                        LEFT JOIN tbl_category c ON p.category_id = c.category_id 
                                        WHERE p.product_name LIKE '%{$search_term}%' 
                                        OR c.category_name LIKE '%{$search_term}%' 
                                        OR p.product_details LIKE '%{$search_term}%'
                                        ORDER BY relevance DESC, p.product_id DESC";
                                    $products = mysqli_query($connection, $query);
                                } elseif (isset($_GET['id'])) {
                                    $products = mysqli_query($connection, "SELECT *from tbl_product_master where category_id='{$_GET['id']}' order By product_id DESC");
                                } else {
                                    $products = mysqli_query($connection, "SELECT *from tbl_product_master order By product_id DESC");
                                }
                                $count = mysqli_num_rows($products);
                                if ($count > 0) {
                                    foreach ($products as $product) {
                                ?>
                                        <div class="product-wrap" style="width: 100%; max-width: 1000px; margin: 0 auto;">
                                            <div class="product product-list" style="display: flex; align-items: flex-start; border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; margin-bottom: 20px; text-align: left; background: #fff; transition: box-shadow 0.3s ease;">
                                                <figure class="product-media" style="flex: 0 0 250px; margin-right: 30px; margin-bottom: 0;">
                                                    <a href="product-details.php?id=<?php echo $product['product_id']; ?>">
                                                        <img src="<?php echo $image_upload_path . $product['product_image']; ?>" title="<?php echo $product["product_name"]; ?>" alt="<?php echo $product["product_name"]; ?>" style="width: 100%; height: 200px; object-fit: contain;">
                                                    </a>
                                                </figure>
                                                <div class="product-details" style="flex: 1; padding: 0;">
                                                    <h3 class="product-name" style="font-size: 20px; font-weight: 600; margin-bottom: 10px; white-space: normal; word-wrap: break-word; line-height: 1.4;">
                                                        <a href="product-details.php?id=<?php echo $product['product_id']; ?>" style="color: #0f1111; text-decoration: none;"><?php echo $product["product_name"]; ?></a>
                                                    </h3>
                                                    <div class="product-price" style="font-size: 24px; font-weight: 700; color: #b12704; margin-bottom: 12px;">
                                                        <?php echo $rupee_symbol . $product["product_price"]; ?>
                                                    </div>
                                                    <div class="product-desc" style="font-size: 14px; color: #565959; margin-bottom: 20px; line-height: 1.5; white-space: normal; word-wrap: break-word;">
                                                        <?php echo isset($product["product_details"]) ? substr(strip_tags($product["product_details"]), 0, 150) . '...' : ''; ?>
                                                    </div>
                                                    <div class="product-action">
                                                        <form method="POST" action="" style="display: flex; gap: 10px; align-items: center; margin-top: 15px; flex-wrap: wrap;">
                                                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                                            <input type="hidden" name="product_quantity" value="<?php echo $product['product_quantity']; ?>">
                                                            <input type="hidden" name="seller_id" value="1">
                                                            
                                                            <button type="submit" name="sample" class="btn btn-primary" style="background-color: #336699; border: none; color: #fff; border-radius: 6px; padding: 0 20px; height: 45px; font-weight: 700; font-size: 14px; display: flex; align-items: center; gap: 8px; transition: background-color 0.2s;">
                                                                <i class="w-icon-cart"></i> ADD TO CART
                                                            </button>
                                                            
                                                            <button type="submit" name="add_to_cart" class="btn btn-primary" style="background-color: #336699; border: none; color: #fff; border-radius: 6px; padding: 0 20px; height: 45px; font-weight: 700; font-size: 14px; display: flex; align-items: center; gap: 8px; transition: background-color 0.2s;">
                                                                <i class="fas fa-bolt"></i> BUY IN BULK
                                                            </button>
                                                            
                                                            <div style="display: flex; align-items: center; border: 1px solid #ddd; border-radius: 6px; overflow: hidden; background: #fff; height: 45px; min-width: 110px;">
                                                                <button type="button" onclick="this.parentNode.querySelector('input').stepDown()" style="background: none; border: none; padding: 0 10px; cursor: pointer; color: #333;"><i class="fas fa-minus"></i></button>
                                                                <input type="number" name="bulk_qty" value="10" min="10" max="<?php echo $product['product_quantity']; ?>" 
                                                                       style="width: 35px; border: none; text-align: center; font-weight: 600; font-size: 14px; border-left: 1px solid #ddd; border-right: 1px solid #ddd; height: 100%; outline: none;">
                                                                <button type="button" onclick="this.parentNode.querySelector('input').stepUp()" style="background: none; border: none; padding: 0 10px; cursor: pointer; color: #333;"><i class="fas fa-plus"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "<h2 style='text-align:center; margin-top: 50px;'>No records Found.</h2>";
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