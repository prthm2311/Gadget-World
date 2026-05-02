<?php
include './common/class.php';
$page_name = "About";
if (isset($_POST['change_details'])) {
    $user_first_name = $_POST['user_first_name'];
    $user_gender = $_POST['user_gender'];
    $user_email = $_POST['user_email'];
    $user_mobile = $_POST['user_mobile'];
    $user_address = $_POST['user_address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $update = mysqli_query($connection, "UPDATE `tbl_user_master` SET `user_first_name`='{$user_first_name}',`user_gender`='{$user_gender}',`user_email`='{$user_email}',`user_mobile`='{$user_mobile}',`user_address`='$user_address',`state`='$state',`city`='$city' WHERE `user_id`='{$_SESSION['user_id']}'");
    if ($update) {
        $_SESSION["user_email"] = $user_email;
        $_SESSION["user_first_name"] = $user_first_name;
        $_SESSION["user_gender"] = $user_gender;
        $_SESSION["user_mobile"] = $user_mobile;
        $_SESSION["user_address"] = $user_address;
        $_SESSION["state"] = $state;
        $_SESSION["city"] = $city;
        echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Profile updated successfully.','success');});</script>";
    } else {
        echo "<script>window.location='index.php?msg=profile_error';</script>";
    }
}
if (isset($_POST['change_password'])) {
    $user_password = $_SESSION['user_password'];
    $cur_password = $_POST['cur_password'];
    $new_password = $_POST['new_password'];
    $conf_password = $_POST['conf_password'];
    if ($user_password == $cur_password) {
        if ($new_password == $conf_password) {
            if ($new_password != $cur_password) {
                $update = mysqli_query($connection, "UPDATE `tbl_user_master` SET `user_password`='{$new_password}' WHERE `user_id`='{$_SESSION['user_id']}'");
                if ($update) {
                    session_destroy();
                    echo "<script>window.location='index.php?msg=password_changed';</script>";
                } else {
                    echo "<script>window.location='index.php?msg=profile_error';</script>";
                }
            } else {
                echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('New password and current password must be different.','error');});</script>";
            }
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('New password and confirm password do not match.','error');});</script>";
        }
    } else {
        echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Current password is incorrect.','error');});</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './theme-part/header-script.php';
    ?>
    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/styling.css">
</head>

<body class="my-account">
    <div class="page-wrapper">
        <!-- Start of Header -->
        <?php
        include './theme-part/header-top.php';
        ?>
        <!-- End of Header -->


        <!-- Start of Main -->
        <main class="main" style="background-color: #f8f9fa; padding-bottom: 60px;">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav" style="background-color: #fff; border-bottom: 1px solid #eee; margin-bottom: 40px; padding: 15px 0;">
                <div class="container">
                    <ul class="breadcrumb" style="margin: 0; padding: 0;">
                        <li><a href="index.php" style="color: #666; text-decoration: none;">Home</a></li>
                        <li style="color: #999; margin-left: 10px;">/ My Account</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content pt-2">
                <div class="container">
                    <div style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 5px 25px rgba(0,0,0,0.05);">
                        <div class="tab tab-vertical row gutter-lg">
                            <ul class="nav nav-tabs mb-6" role="tablist">
                            <li class="nav-item">
                                <a href="#account-dashboard" class="nav-link active">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="#account-orders" class="nav-link">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a href="#account-details" class="nav-link">Account details</a>
                            </li>
                            <li class="nav-item">
                                <a href="#account-password-change" class="nav-link">Change Password</a>
                            </li>
                            <li class="link-item">
                                <a href="log-out.php">Logout</a>
                            </li>
                        </ul>
                        <div class="tab-content mb-6">
                            <div class="tab-pane active in" id="account-dashboard">
                                <p class="greeting">
                                    Hello
                                    <span class="text-dark font-weight-bold"><?php echo $_SESSION['user_first_name'] ?></span>
                                    (not
                                    <span class="text-dark font-weight-bold"><?php echo $_SESSION['user_first_name'] ?></span>?
                                    <a href="log-out.php" class="text-primary">Log out</a>)
                                </p>

                                <p class="mb-4">
                                    From your account dashboard you can view your <a href="#account-orders" class="text-primary link-to-tab">recent orders</a>,<a href="#account-password-change" class="text-primary link-to-tab">edit your password</a>, and
                                    <a href="#account-details" class="text-primary link-to-tab">account details.</a>
                                </p>

                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                        <a href="#account-orders" class="link-to-tab">
                                            <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-orders">
                                                    <i class="w-icon-orders"></i>
                                                </span>
                                                <div class="icon-box-content">
                                                    <p class="text-uppercase mb-0">Orders</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                        <a href="#">
                                            <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-logout">
                                                    <i class="w-icon-logout"></i>
                                                </span>
                                                <div class="icon-box-content">
                                                    <p class="text-uppercase mb-0">Logout</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane mb-4" id="account-orders">
                                <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                                    </div>
                                </div>

                                <table class="shop-table account-orders-table mb-6">
                                    <thead>
                                        <tr>
                                            <th class="order-id">Order</th>
                                            <th class="order-date">Date</th>
                                            <th class="order-status">Status</th>
                                            <th class="order-total">Total</th>
                                            <th class="order-actions">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=0;
                                        $orders = mysqli_query($connection, "SELECT *from tbl_order_master where `user_id`='{$_SESSION['user_id']}'");
                                        $ordersData = mysqli_fetch_all($orders);
                                        foreach ($ordersData as $order) {
                                            $i++;
                                        ?>
                                            <tr>
                                                <td class="order-id text-center"><?php echo $i ?></td>
                                                <td class="order-date text-center"><?php echo $order[1] ?></td>
                                                <td class="order-status text-center"><?php echo $order[5] ?></td>
                                                <td class="order-total text-center">
                                                    <span class="order-price">Rs. <?php echo $order[4] ?></span>
                                                </td>
                                                <td class="order-action text-center">
                                                    <a href="order-details.php?id=<?php echo $order[0]; ?>" class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <a href="shop.php" class="btn btn-dark btn-rounded btn-icon-right">Go
                                    Shop<i class="w-icon-long-arrow-right"></i></a>
                            </div>
                            <div class="tab-pane" id="account-details">
                                <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-account mr-2">
                                        <i class="w-icon-user"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
                                    </div>
                                </div>
                                <form class="form account-details-form" action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="user_first_name">Name *</label>
                                                <input type="text" id="user_first_name" value="<?php echo $_SESSION['user_first_name'] ?>" name="user_first_name" class="form-control form-control-md" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="user_gender">Gender *</label>
                                                <input type="text" id="user_gender" name="user_gender" value="<?php echo $_SESSION['user_gender'] ?>" class="form-control form-control-md mb-0">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="email_1">Email address *</label>
                                                <input type="email" id="user_email" value="<?php echo $_SESSION['user_email'] ?>" name="user_email" class="form-control form-control-md" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="user_mobile">Mobile *</label>
                                                <input type="number" id="user_mobile" value="<?php echo $_SESSION['user_mobile'] ?>" name="user_mobile" class="form-control form-control-md">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="user_address">Address *</label>
                                                <textarea name="user_address" required class="form-control form-control-md"><?php echo $_SESSION['user_address'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="user_password">Your State</label>
                                                <select class="form-control" name="state" id="state">
                                                    <option value="Gujarat">Gujarat</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="user_password">Your City</label>
                                                <select class="form-control" name="city" id="city">
                                                    <option value="Ahmadabad" <?php if ($_SESSION['city'] == "Ahmadabad") echo "selected"; ?>>Ahmadabad</option>
                                                    <option value="Amreli" <?php if ($_SESSION['city'] == "Amreli") echo "selected"; ?>>Amreli</option>
                                                    <option value="Bharuch" <?php if ($_SESSION['city'] == "Bharuch") echo "selected"; ?>>Bharuch</option>
                                                    <option value="Bhavnagar" <?php if ($_SESSION['city'] == "Bhavnagar") echo "selected"; ?>>Bhavnagar</option>
                                                    <option value="Bhuj" <?php if ($_SESSION['city'] == "Bhuj") echo "selected"; ?>>Bhuj</option>
                                                    <option value="Dwarka" <?php if ($_SESSION['city'] == "Dwarka") echo "selected"; ?>>Dwarka</option>
                                                    <option value="Gandhinagar" <?php if ($_SESSION['city'] == "Gandhinagar") echo "selected"; ?>>Gandhinagar</option>
                                                    <option value="Godhra" <?php if ($_SESSION['city'] == "Godhra") echo "selected"; ?>>Godhra</option>
                                                    <option value="Jamnagar" <?php if ($_SESSION['city'] == "Jamnagar") echo "selected"; ?>>Jamnagar</option>
                                                    <option value="Junagadh" <?php if ($_SESSION['city'] == "Junagadh") echo "selected"; ?>>Junagadh</option>
                                                    <option value="Kandla" <?php if ($_SESSION['city'] == "Kandla") echo "selected"; ?>>Kandla</option>
                                                    <option value="Khambhat" <?php if ($_SESSION['city'] == "Khambhat") echo "selected"; ?>>Khambhat</option>
                                                    <option value="Kheda" <?php if ($_SESSION['city'] == "Kheda") echo "selected"; ?>>Kheda</option>
                                                    <option value="Mahesana" <?php if ($_SESSION['city'] == "Mahesana") echo "selected"; ?>>Mahesana</option>
                                                    <option value="Morbi" <?php if ($_SESSION['city'] == "Morbi") echo "selected"; ?>>Morbi</option>
                                                    <option value="Nadiad" <?php if ($_SESSION['city'] == "Nadiad") echo "selected"; ?>>Nadiad</option>
                                                    <option value="Navsari" <?php if ($_SESSION['city'] == "Navsari") echo "selected"; ?>>Navsari</option>
                                                    <option value="Okha" <?php if ($_SESSION['city'] == "Okha") echo "selected"; ?>>Okha</option>
                                                    <option value="Palanpur" <?php if ($_SESSION['city'] == "Palanpur") echo "selected"; ?>>Palanpur</option>
                                                    <option value="Patan" <?php if ($_SESSION['city'] == "Patan") echo "selected"; ?>>Patan</option>
                                                    <option value="Porbandar" <?php if ($_SESSION['city'] == "Porbandar") echo "selected"; ?>>Porbandar</option>
                                                    <option value="Rajkot" <?php if ($_SESSION['city'] == "Rajkot") echo "selected"; ?>>Rajkot</option>
                                                    <option value="Surat" <?php if ($_SESSION['city'] == "Surat") echo "selected"; ?>>Surat</option>
                                                    <option value="Surendranagar" <?php if ($_SESSION['city'] == "Surendranagar") echo "selected"; ?>>Surendranagar</option>
                                                    <option value="Valsad" <?php if ($_SESSION['city'] == "Valsad") echo "selected"; ?>>Valsad</option>
                                                    <option value="Veraval" <?php if ($_SESSION['city'] == "Veraval") echo "selected"; ?>>Veraval</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-4" name="change_details" style="background-color: #336699; border-color: #336699; padding: 12px 25px; font-weight: 600; border-radius: 6px;">Save Changes</button>
                                </form>
                            </div>
                            <div class="tab-pane" id="account-password-change">
                                <form class="form account-details-form" method="post">
                                    <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
                                    <div class="form-group">
                                        <label class="text-dark" for="cur_password">Current Password leave blank to leave unchanged</label>
                                        <input type="password" class="form-control form-control-md" id="cur_password" name="cur_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark" for="new_password">New Password leave blank to leave unchanged</label>
                                        <input type="password" class="form-control form-control-md" id="new_password" name="new_password" required>
                                    </div>
                                    <div class="form-group mb-10">
                                        <label class="text-dark" for="conf_password">Confirm Password</label>
                                        <input type="password" class="form-control form-control-md" id="conf_password" name="conf_password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-4" name="change_password" style="background-color: #336699; border-color: #336699; padding: 12px 25px; font-weight: 600; border-radius: 6px;">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
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
</body>

</html>