<?php
include './common/class.php';
$page_name = "Login";
if (isset($_POST['login'])) {
    $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
    $query = mysqli_query($connection, "select *from tbl_user_master where user_email='{$user_email}' and user_password='{$user_password}'") or die(mysqli_error($connection));
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $row = mysqli_fetch_array($query);
        $user_id = $row['user_id'];
        $user_email = $row['user_email'];
        $user_first_name = $row['user_first_name'];
        $user_last_name = $row['user_last_name'];
        $user_gender = $row['user_gender'];
        $user_mobile = $row['user_mobile'];
        $user_address = $row['user_address'];
        $user_password = $row['user_password'];
        $state = $row['state'];
        $city = $row['city'];
        $_SESSION["user_id"] = $user_id;
        $_SESSION["user_email"] = $user_email;
        $_SESSION["user_first_name"] = $user_first_name;
        $_SESSION["user_last_name"] = $user_last_name;
        $_SESSION["user_gender"] = $user_gender;
        $_SESSION["user_mobile"] = $user_mobile;
        $_SESSION["user_address"] = $user_address;
        $_SESSION["user_password"] = $user_password;
        $_SESSION["state"] = $state;
        $_SESSION["city"] = $city;
        echo "<script>window.location='index.php?msg=login_success';</script>";
    } else {
        echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Login failed. Email or password does not match.','error');});</script>";
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
        <main class="main" style="background-color: #f8f9fa; padding: 60px 0; min-height: 60vh; display: flex; align-items: center;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8">
                        <div style="background: #fff; padding: 50px 40px; border-radius: 12px; box-shadow: 0 5px 25px rgba(0,0,0,0.05); text-align: left;">
                            <h3 class="title text-center mb-6" style="font-size: 28px; font-weight: 700; color: #333;">Sign In</h3>
                            <form class="form" method="post">
                                <div class="form-group mb-4">
                                    <label for="user_email" style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">Email Address</label>
                                    <input type="email" id="user_email" name="user_email" class="form-control" placeholder="Enter your email" required style="border-radius: 6px; padding: 14px; border: 1px solid #ddd; background-color: #fdfdfd; font-size: 15px;">
                                </div>
                                <div class="form-group mb-6">
                                    <label for="user_password" style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">Password</label>
                                    <input type="password" id="user_password" name="user_password" class="form-control" placeholder="Enter your password" required style="border-radius: 6px; padding: 14px; border: 1px solid #ddd; background-color: #fdfdfd; font-size: 15px;">
                                </div>
                                <button type="submit" class="btn btn-primary w-100" name="login" style="background-color: #336699; border-color: #336699; padding: 14px; font-weight: 600; font-size: 16px; border-radius: 6px; display: block; width: 100%;">Sign In</button>
                            </form>
                            <div style="text-align: center; margin-top: 25px;">
                                <a href="forgot-password.php" style="color: #336699; font-weight: 500; font-size: 14px;">Forgot Password?</a>
                            </div>
                            <div style="text-align: center; margin-top: 15px; font-size: 14px; color: #777;">
                                Don't have an account? <a href="registration.php" style="color: #336699; font-weight: 600;">Register here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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