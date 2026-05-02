<?php
include './common/class.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Check if we came from the payment gateway
    if (isset($_POST['pay-now'])) {
        $total_amount = $_POST['total_amount'];
        $payment_method_raw = $_POST['payment_method']; // 'card' or 'cod'
        $payment_method = ($payment_method_raw == 'cod') ? 2 : 1; // 1 for Card, 2 for COD
        $order_date = date('Y-m-d');
        $order_time = date('H:i:s');
        $order_status = "Pending";

        // 1. Create the Order Master record
        $order_master_query = "INSERT INTO `tbl_order_master`(`order_date`, `order_time`, `user_id`, `total_amount`, `order_status`, `payment_method`) 
                               VALUES ('$order_date', '$order_time', '$user_id', '$total_amount', '$order_status', '$payment_method')";
        $order_master_result = mysqli_query($connection, $order_master_query) or die(mysqli_error($connection));

        if ($order_master_result) {
            $order_id = mysqli_insert_id($connection);

            // 2. Fetch cart items for the user
            $cartQuery = mysqli_query($connection, "SELECT * FROM tbl_cart WHERE `user_id`='$user_id'");
            
            while ($cartRow = mysqli_fetch_assoc($cartQuery)) {
                $product_id = $cartRow['product_id'];
                $seller_id = $cartRow['seller_id'];
                $product_qty = $cartRow['product_qty'];
                
                // Fetch product price to calculate item total
                $p_query = mysqli_query($connection, "SELECT product_price FROM tbl_product_master WHERE product_id='$product_id'");
                $p_data = mysqli_fetch_assoc($p_query);
                $price = $p_data['product_price'];
                
                $item_total = $price * $product_qty;
                
                // Apply 20% discount if quantity >= 20 (matching site-wide logic)
                if ($product_qty >= 20) {
                    $item_total -= ($item_total * 0.20);
                }

                // 3. Create Order Detail record for each item
                $order_detail_query = "INSERT INTO `tbl_order_details`(`order_id`, `product_id`, `product_qty`, `total_amount`, `seller_id`) 
                                       VALUES ('$order_id', '$product_id', '$product_qty', '$item_total', '$seller_id')";
                mysqli_query($connection, $order_detail_query) or die(mysqli_error($connection));
            }

            // 4. Clear the cart now that everything is officially ordered
            mysqli_query($connection, "DELETE FROM `tbl_cart` WHERE `user_id`='{$user_id}'");
        }
    } else {
        // If someone tries to access success.php directly without a payment post
        echo "<script>window.location='index.php';</script>";
        exit();
    }
} else {
    echo "<script>window.location='login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .success-box {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .success-box h1 {
            color: #28a745;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .success-box p {
            font-size: 16px;
            color: #333333;
        }
        .success-box .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .success-box .button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-box">
            <h1>Payment Successful!</h1>
            <p>Thank you for your payment. Your transaction has been completed successfully.</p>
            <p>We have sent you an email confirmation. If you have any questions, feel free to contact us.</p>
            <a href="./index.php" class="button">Return to Homepage</a>
        </div>
    </div>
</body>
</html>
