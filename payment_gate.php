<?php
include './common/class.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location='index.php';</script>"; // Redirect if user is not logged in
}

$user_id = $_SESSION['user_id'];    

// Retrieve order_id if available, otherwise it's handled below via query
$order_id = isset($_SESSION['order_id']) ? $_SESSION['order_id'] : null;

// Fetch cart items for the user to calculate the total amount
$cartQuery = mysqli_query($connection, "SELECT * FROM tbl_cart WHERE `user_id`='$user_id'");
$total_amount = 0;

if (mysqli_num_rows($cartQuery) > 0) {
    while ($cartRow = mysqli_fetch_assoc($cartQuery)) {
        $p_id = $cartRow['product_id'];
        $p_qty = $cartRow['product_qty'];
        
        $p_query = mysqli_query($connection, "SELECT product_price FROM tbl_product_master WHERE product_id='$p_id'");
        $p_data = mysqli_fetch_assoc($p_query);
        $price = $p_data['product_price'];
        
        $subtotal = $price * $p_qty;
        
        // Apply 20% discount if quantity >= 20 (matching cart.php logic)
        if ($p_qty >= 20) {
            $subtotal -= ($subtotal * 0.20);
        }
        
        $total_amount += $subtotal;
    }
} else {
    // If cart is empty, redirect back to shop
    echo "<script>window.location='shop.php';</script>";
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - <?php echo $project_title; ?></title>
    <?php include './theme-part/header-script.php'; ?>
    <style>
        /* Overriding any conflicting styles from Payment.css */
        .checkout form input:focus { border-color: #336699 !important; box-shadow: 0 0 0 2px rgba(51,102,153,0.1); outline: none; }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <?php include './theme-part/header-top.php'; ?>
        
        <main class="main checkout">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="passed"><a href="cart.php">Shopping Cart</a></li>
                        <li class="active"><a href="payment_gate.php">Checkout</a></li>
                        <li><a href="#">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->
            
            <div class="page-content pb-10">
                <div class="container" style="display: flex; justify-content: center; background-color: transparent;">
                    <form method="POST" action="./success.php" style="width: 100%; max-width: 900px; padding: 40px; background: #fff; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); border: 1px solid #eee; margin-bottom: 40px;">
                        <h2 class="title" style="margin-bottom: 30px; border-bottom: 2px solid #f4f4f4; padding-bottom: 15px; color: #333; font-weight: 600;">Secure Checkout</h2>
                        <div class="row">
                            <!-- Billing Details Column -->
                            <div class="col-md-6 mb-4" style="padding-right: 20px;">
                                <h3 class="title" style="font-size: 18px; margin-bottom: 20px; color: #555;">Billing Details</h3>
                                <div class="inputBox" style="margin-bottom: 15px;">
                                    <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">Amount You Pay</span>
                                    <input type="text" value="<?php echo $rupee_symbol . $total_amount; ?>" required readonly style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; background-color: #f9f9f9; color: #333; font-weight: bold; font-size: 16px;">
                                    <input type="hidden" value="<?php echo $total_amount; ?>" name="total_amount">
                                </div>
                                <div class="inputBox" style="margin-bottom: 15px;">
                                    <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">Full Name</span>
                                    <input type="text" placeholder="Enter your name" name="name" required pattern="[A-Za-z\s]+" title="Please enter only alphabets" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; transition: border-color 0.3s;">
                                </div>
                                <div class="inputBox" style="margin-bottom: 15px;">
                                    <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">Email Address</span>
                                    <input type="email" placeholder="Enter your email" name="email" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; transition: border-color 0.3s;">
                                </div>
                                <div class="inputBox" style="margin-bottom: 15px;">
                                    <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">Address</span>
                                    <input type="text" placeholder="Enter your full address" name="address" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; transition: border-color 0.3s;">
                                </div>
                                <div class="inputBox" style="margin-bottom: 15px;">
                                    <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">City</span>
                                    <input type="text" placeholder="Enter your city" name="city" required pattern="[A-Za-z\s]+" title="Please enter only alphabets" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; transition: border-color 0.3s;">
                                </div>
                                <div class="flex" style="display: flex; gap: 15px; margin-bottom: 15px;">
                                    <div class="inputBox" style="flex: 1;">
                                        <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">State</span>
                                        <input type="text" placeholder="State" name="state" required pattern="[A-Za-z\s]+" title="Please enter only alphabets" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; transition: border-color 0.3s;">
                                    </div>
                                    <div class="inputBox" style="flex: 1;">
                                        <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">Zip Code</span>
                                        <input type="text" placeholder="Zip code" name="zip" required pattern="\d{6}" title="Please enter a valid 6-digit zip code" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; transition: border-color 0.3s;">
                                    </div>
                                </div>
                                <div class="inputBox" style="margin-bottom: 15px;">
                                    <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">Country</span>
                                    <input type="text" value="INDIA" name="country" readonly style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; background-color: #f9f9f9; color: #555;">
                                </div>
                            </div>

                            <!-- Payment Details Column -->
                            <div class="col-md-6 mb-4" style="padding-left: 20px; border-left: 1px solid #eee;">
                                <h3 class="title" style="font-size: 18px; margin-bottom: 20px; color: #555;">Payment Information</h3>
                                
                                <div class="payment-methods" style="margin-bottom: 25px;">
                                    <label style="display: block; margin-bottom: 10px; cursor: pointer; padding: 12px; border: 1px solid #336699; border-radius: 6px; background-color: #f0f8ff; transition: all 0.3s;">
                                        <input type="radio" name="payment_method" value="card" checked onclick="togglePayment(this.value)" style="margin-right: 10px;"> Credit / Debit Card
                                    </label>
                                    <label style="display: block; cursor: pointer; padding: 12px; border: 1px solid #ddd; border-radius: 6px; transition: all 0.3s;">
                                        <input type="radio" name="payment_method" value="cod" onclick="togglePayment(this.value)" style="margin-right: 10px;"> Cash on Delivery (COD)
                                    </label>
                                </div>
                                
                                <div id="card-details">
                                    <div class="inputBox" style="margin-bottom: 20px;">
                                        <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">Cards Accepted</span>
                                        <img src="./assets/images/cards.jpeg" alt="Accepted Cards" style="max-height: 35px; border-radius: 4px; border: 1px solid #eee;">
                                    </div>
                                    <div class="inputBox" style="margin-bottom: 15px;">
                                        <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">Name on Card</span>
                                        <input type="text" placeholder="E.g. John Doe" name="cardName" required pattern="[A-Za-z\s]+" title="Please enter only alphabets" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; transition: border-color 0.3s;">
                                    </div>
                                    <div class="inputBox" style="margin-bottom: 15px;">
                                        <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">Credit Card Number</span>
                                        <div style="position: relative;">
                                            <input type="text" placeholder="0000 0000 0000 0000" name="cardNumber" pattern="\d{16}" maxlength="16" required title="Please enter a 16-digit card number" style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #ddd; border-radius: 6px; transition: border-color 0.3s; letter-spacing: 1px;">
                                            <i class="w-icon-wallet" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #999; font-size: 18px;"></i>
                                        </div>
                                    </div>
                                    <div class="flex" style="display: flex; gap: 15px; margin-bottom: 15px;">
                                        <div class="inputBox" style="flex: 2;">
                                            <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">Expiry Date</span>
                                            <input type="text" name="expM" placeholder="MM/YY" maxlength="5" id="expiry-date" required pattern="\d{2}/\d{2}" title="Enter format MM/YY" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; transition: border-color 0.3s; color: #555;">
                                        </div>
                                        <div class="inputBox" style="flex: 1;">
                                            <span style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #666;">CVV</span>
                                            <input type="text" placeholder="123" name="cvv" pattern="\d{3,4}" maxlength="4" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; transition: border-color 0.3s;">
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="cod-details" style="display: none; padding: 25px 20px; background-color: #f9f9f9; border-radius: 8px; border: 1px dashed #ccc; margin-bottom: 15px; text-align: center;">
                                    <i class="w-icon-truck" style="font-size: 40px; color: #336699; margin-bottom: 15px; display: block;"></i>
                                    <h4 style="margin-bottom: 10px; color: #333;">Pay upon delivery</h4>
                                    <p style="color: #666; font-size: 14px; margin: 0; line-height: 1.5;">You will pay exactly <strong><?php echo $rupee_symbol . $total_amount; ?></strong> in cash to the courier when your order arrives at your address.</p>
                                </div>
                                
                                <div class="payment-action" style="margin-top: 40px;">
                                    <button type="submit" name="pay-now" style="width: 100%; padding: 16px; font-size: 16px; font-weight: 600; background-color: #336699; color: white; border: none; border-radius: 8px; cursor: pointer; transition: all 0.3s; display: flex; justify-content: center; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(51,102,153,0.3);">
                                        <i class="w-icon-lock" style="font-size: 18px;"></i> <span id="pay-btn-text">Securely Pay <?php echo $rupee_symbol . $total_amount; ?></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <?php include './theme-part/footer.php'; ?>
    </div>
    
    <?php include './theme-part/header.php'; ?>
    <?php include './theme-part/mobile-menu.php'; ?>
    <?php include './theme-part/footer-script.php'; ?>
    
    <script>
        // Auto-format expiry date MM/YY
        document.getElementById('expiry-date').addEventListener('input', function (e) {
            let input = e.target.value.replace(/\D/g, ''); // Remove non-digits
            if (input.length >= 2) {
                e.target.value = input.substring(0, 2) + '/' + input.substring(2, 4);
            } else {
                e.target.value = input;
            }
        });

        // Prevent numbers in alphabet-only fields
        const alphaFields = document.querySelectorAll('input[name="name"], input[name="city"], input[name="state"], input[name="cardName"]');
        alphaFields.forEach(field => {
            field.addEventListener('keydown', function (e) {
                if (e.key >= '0' && e.key <= '9') {
                    e.preventDefault();
                }
            });
            // Also clean up on paste
            field.addEventListener('input', function (e) {
                e.target.value = e.target.value.replace(/[0-9]/g, '');
            });
        });

        function togglePayment(method) {
            const cardDetails = document.getElementById('card-details');
            const codDetails = document.getElementById('cod-details');
            const cardInputs = cardDetails.querySelectorAll('input');
            
            // Labels styling
            const radios = document.getElementsByName('payment_method');
            radios.forEach(radio => {
                if(radio.checked) {
                    radio.parentElement.style.borderColor = '#336699';
                    radio.parentElement.style.backgroundColor = '#f0f8ff';
                } else {
                    radio.parentElement.style.borderColor = '#ddd';
                    radio.parentElement.style.backgroundColor = 'transparent';
                }
            });

            if (method === 'cod') {
                cardDetails.style.display = 'none';
                codDetails.style.display = 'block';
                document.getElementById('pay-btn-text').innerText = 'Place Order (Cash on Delivery)';
                // Remove required attribute so form can submit without card details
                cardInputs.forEach(input => input.removeAttribute('required'));
            } else {
                cardDetails.style.display = 'block';
                codDetails.style.display = 'none';
                document.getElementById('pay-btn-text').innerText = 'Securely Pay <?php echo $rupee_symbol . $total_amount; ?>';
                // Add back required attribute
                cardInputs.forEach(input => input.setAttribute('required', 'required'));
            }
        }
    </script>
</body>
</html>
