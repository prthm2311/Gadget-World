<?php
include './common/class.php';
$page_name = "Cart";

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location='index.php';</script>";
}

$cart = mysqli_query($connection, "SELECT * FROM tbl_cart WHERE `user_id`='{$_SESSION['user_id']}'") or die($connection);
$cartDetails = mysqli_fetch_all($cart);
$countCart = mysqli_num_rows($cart);

// Clear cart functionality
if (isset($_POST['clear_cart'])) {
    $query = mysqli_query($connection, "DELETE FROM `tbl_cart` WHERE `user_id`='{$_SESSION['user_id']}'");
    if ($query) {
        echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Your cart has been cleared.','info');});</script>";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Something went wrong. Please try again later.','error');});</script>";
    }
}

// Remove product from cart functionality
if (isset($_POST['cross_btn'])) {
    $user_id = $_SESSION['user_id'];
    $product = $_POST['product_id']; // Get product ID from the form submission

    // SQL query to delete the product from the cart
    $query = mysqli_query($connection, "DELETE FROM `tbl_cart` WHERE `user_id`='{$user_id}' AND `product_id`='{$product}'") or die(mysqli_error($connection));
    if ($query) {
        echo "<script>window.location='cart.php?msg=removed';</script>";
    } else {
        echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Failed to remove product. Please try again.','error');});</script>";
    }
}

// Update cart quantity functionality
if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id']; // Get cart ID
    $new_quantity = intval($_POST['update_quantity']); // Get the new quantity
    $max_stock = intval($_POST['product_quantity']); // Get available stock

    if ($new_quantity < 1) $new_quantity = 1;

    if ($new_quantity > $max_stock) {
        echo "<script>window.location='cart.php?msg=stock_exceeded&max=$max_stock';</script>";
    } else {
        // Update the cart with the new quantity
        $updateQuery = mysqli_query($connection, "UPDATE `tbl_cart` SET `product_qty`='$new_quantity' WHERE `cart_id`='$cart_id' AND `user_id`='{$_SESSION['user_id']}'") or die(mysqli_error($connection));

        if ($updateQuery) {
            echo "<script>window.location='cart.php?msg=qty_updated';</script>";
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Failed to update quantity. Please try again.','error');});</script>";
        }
    }
}

// Checkout functionality
if (isset($_POST['check_out'])) {
    // We no longer create the order here. 
    // We just redirect to the payment gateway.
    // The order will be created in success.php after payment verification.
    echo "<script>window.location='./payment_gate.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include './theme-part/header-script.php'; ?>
<!-- Default CSS -->
<link rel="stylesheet" type="text/css" href="assets/css/styling.css">
</head>

<body>
<div class="page-wrapper">
<?php include './theme-part/header-top.php'; ?>

<!-- Start of Main -->
<main class="main cart">
<!-- Start of Breadcrumb -->
<nav class="breadcrumb-nav">
<div class="container">
<ul class="breadcrumb shop-breadcrumb bb-no">
<li class="active">Shopping Cart</li>
</ul>
</div>
</nav>
<!-- End of Breadcrumb -->

<!-- Start of PageContent -->
<div class="page-content">
<div class="container">
<div class="row gutter-lg mb-10">
<div class="col-lg-12 pr-lg-12 mb-6">
<?php if ($countCart > 0) { ?>
    <table class="shop-table cart-table">
    <thead>
    <tr>
    <th class="product-name"><span>Product</span></th>
    <th></th>
    <th class="product-price"><span>Price</span></th>
    <th class="product-quantity"><span>Quantity</span></th>
    <th class="product-subtotal"><span>Subtotal</span></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $subTotal = 0;
    foreach ($cartDetails as $cartDetail) {
        $product = mysqli_query($connection, "SELECT * FROM tbl_product_master WHERE `product_id`='{$cartDetail[3]}'") or die($connection);
        $productDetails = mysqli_fetch_assoc($product);

        // Calculate subtotal
        $productPrice = $productDetails["product_price"];
        $productQty = $cartDetail[4];
        $productSubtotal = $productPrice * $productQty;

        // Apply 20% discount if quantity >= 20
        if ($productQty >= 20) {
            $discount = $productSubtotal * 0.20; // 20% discount
            $productSubtotal -= $discount;
        }

        $subTotal += $productSubtotal;
        ?>
        <tr>
        <td class="product-thumbnail">
        <div class="p-relative">
        <a href="product-details.php?id=<?php echo $productDetails['product_id']; ?>">
        <figure>
        <img src="<?php echo $image_upload_path . $productDetails['product_image']; ?>" alt="product" style="width: 100px;height: 113px;">
        </figure>
        </a>
        <form method="POST" action="">
        <input type="hidden" name="product_id" value="<?php echo $cartDetail[3]; ?>">
        <button type="submit" class="btn btn-close" name="cross_btn"><i class="fas fa-times"></i></button>
        </form>
        </div>
        </td>
        <td class="product-name">
        <a href="product-details.php?id=<?php echo $productDetails['product_id']; ?>">
        <?php echo $productDetails['product_name'] ?>
        </a>
        </td>
        <td class="product-price">
        <span class="amount"><?php echo $rupee_symbol . $productDetails["product_price"]; ?></span>
        </td>
        <form method="POST">
        <td class="product-quantity">
        <div class="input-group">
        <input type="hidden" value="<?php echo $cartDetail[0]; ?>" name="cart_id">
        <input type="hidden" value="<?php echo $productDetails["product_quantity"]; ?>" name="product_quantity">
        <input class="text-center" type="number" value="<?php echo $cartDetail[4]; ?>" name="update_quantity" min="1" max="<?php echo $productDetails['product_quantity']; ?>" style="width: 62px;">
        <input type="submit" class="btn btn-primary" name="update_cart" value="Update">
        </div>
        </td>
        </form>
        <td class="product-subtotal">
        <span class="amount"><?php echo $rupee_symbol . $productSubtotal; ?></span>
        </td>
        </tr>
        <?php } ?>
        <tr>
        <td class="product-thumbnail"></td>
        <td class="product-name"></td>
        <td class="product-price"></td>
        <td class="product-name">Sub total</td>
        <td class="product-subtotal">
        <span class="amount"><?php echo $rupee_symbol . $subTotal; ?></span>
        </td>
        </tr>
        </tbody>
        </table>

        <div class="cart-action mb-6" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap; margin-top: 20px;">
            <a href="shop.php" class="btn btn-rounded btn-icon-left btn-shopping" style="background-color: #336699; color: white; border-color: #336699; padding: 10px 20px; font-weight: 600;"><i class="w-icon-long-arrow-left" style="margin-right: 8px;"></i>Continue Shopping</a>
            <form method="POST" style="margin: 0;">
                <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear_cart" value="Clear Cart" style="padding: 10px 20px;">Clear Cart</button>
            </form>
            <form method="POST" style="margin: 0; margin-left: auto;">
                <input type="hidden" value="<?php echo $subTotal ?>" name="total_amount" id="total_amount">
                <button type="submit" class="btn btn-rounded" name="check_out" value="Check Out" style="background-color: #28a745; color: white; border-color: #28a745; padding: 10px 25px; font-weight: 600;">Check Out <i class="w-icon-long-arrow-right" style="margin-left: 8px;"></i></button>
            </form>
        </div>
        <?php } else { ?>
            <div class="alert alert-warning" style="margin-bottom: 20px; padding: 15px; border-radius: 5px;">Your Cart is Empty.</div>
            <a href="shop.php" class="btn btn-rounded btn-icon-left" style="background-color: #336699; color: white; border-color: #336699; padding: 12px 25px; font-weight: 600; display: inline-flex; align-items: center;"><i class="w-icon-long-arrow-left" style="margin-right: 8px;"></i>Continue Shopping</a>
            <?php } ?>
            </div>
            </div>
            </div>
            </div>
            <!-- End of PageContent -->
            </main>
            <!-- End of Main -->

            <?php include './theme-part/footer.php'; ?>
            </div>
            <!-- End of Page Wrapper -->

            <?php include './theme-part/footer-script.php'; ?>
            </body>

            </html>
