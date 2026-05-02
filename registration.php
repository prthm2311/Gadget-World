<?php
include './common/class.php';
$page_name = "Register";
if (isset($_POST['registration'])) {
    $table = "tbl_user_master";
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_gender = $_POST['user_gender'];
    $user_email = $_POST['user_email'];
    $user_mobile = $_POST['user_mobile'];
    $user_password = $_POST['user_password'];
    $user_address = $_POST['user_address'];
    $user_dob = $_POST['user_dob'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $query_check = mysqli_query($connection, "select lower(user_email) from $table where user_email=lower('{$user_email}')") or die(mysqli_error($connection));
    $count = mysqli_num_rows($query_check);
    if ($count > 0) {
        echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Email already exists. Please use a different email.','error');});</script>";
    } else {
        $insert = mysqli_query($connection, "INSERT INTO `tbl_user_master`(`user_first_name`, `user_last_name`,`user_gender`, `user_email`, `user_mobile`, `user_password`, `user_address`,`user_dob`,`state`,`city`) VALUES ('{$user_first_name}','{$user_last_name}','{$user_gender}','{$user_email}','{$user_mobile}','{$user_password}','{$user_address}','{$user_dob}','{$state}','{$city}')");
        if ($insert) {
            echo "<script>window.location='login.php?msg=register_success';</script>";
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded',function(){showToast('Registration failed. Please try again later.','error');});</script>";
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
        <main class="main" style="background-color: #f8f9fa; padding: 60px 0; min-height: 60vh; display: flex; align-items: center;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div style="background: #fff; padding: 50px 40px; border-radius: 12px; box-shadow: 0 5px 25px rgba(0,0,0,0.05); text-align: left;">
                            <h3 class="title text-center mb-6" style="font-size: 28px; font-weight: 700; color: #333;">Create an Account</h3>
                            <form class="form" method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="user_first_name" style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">First Name</label>
                                        <input type="text" id="user_first_name" name="user_first_name" class="form-control" required style="border-radius: 6px; padding: 14px; border: 1px solid #ddd; background-color: #fdfdfd; font-size: 15px;">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="user_last_name" style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">Last Name</label>
                                        <input type="text" id="user_last_name" name="user_last_name" class="form-control" required style="border-radius: 6px; padding: 14px; border: 1px solid #ddd; background-color: #fdfdfd; font-size: 15px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="user_email" style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">Email Address</label>
                                        <input type="email" id="user_email" name="user_email" class="form-control" required style="border-radius: 6px; padding: 14px; border: 1px solid #ddd; background-color: #fdfdfd; font-size: 15px;">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="user_mobile" style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">Mobile Number</label>
                                        <input type="text" onkeypress="return isNumber(event)" id="user_mobile" maxlength="10" name="user_mobile" class="form-control" required style="border-radius: 6px; padding: 14px; border: 1px solid #ddd; background-color: #fdfdfd; font-size: 15px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">Gender</label>
                                        <div style="display: flex; gap: 20px; align-items: center; height: 50px; padding: 0 14px; border: 1px solid #ddd; border-radius: 6px; background-color: #fdfdfd;">
                                            <label style="margin: 0; cursor: pointer; display: flex; align-items: center;"><input type="radio" name="user_gender" value="Male" style="margin-right: 8px;"> Male</label>
                                            <label style="margin: 0; cursor: pointer; display: flex; align-items: center;"><input type="radio" name="user_gender" value="Female" style="margin-right: 8px;"> Female</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="user_password" style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">Password</label>
                                        <input type="password" id="user_password" name="user_password" class="form-control" required style="border-radius: 6px; padding: 14px; border: 1px solid #ddd; background-color: #fdfdfd; font-size: 15px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label for="user_dob" style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">Date of Birth</label>
                                        <input type="date" id="user_dob" name="user_dob" class="form-control" required style="border-radius: 6px; padding: 14px; border: 1px solid #ddd; background-color: #fdfdfd; font-size: 15px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label for="user_address" style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">Address</label>
                                        <textarea id="user_address" name="user_address" class="form-control" required style="border-radius: 6px; padding: 14px; border: 1px solid #ddd; background-color: #fdfdfd; font-size: 15px; min-height: 100px;"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-5">
                                        <label for="state" style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">State</label>
                                        <select class="form-control" name="state" id="state" style="border-radius: 6px; height: 50px; border: 1px solid #ddd; background-color: #fdfdfd; font-size: 15px;">
                                            <option value="Gujarat">Gujarat</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-5">
                                        <label for="city" style="font-weight: 600; margin-bottom: 8px; display: block; color: #555;">City</label>
                                        <select class="form-control" name="city" id="city" style="border-radius: 6px; height: 50px; border: 1px solid #ddd; background-color: #fdfdfd; font-size: 15px;">
                                            <option value="Ahmadabad">Ahmadabad</option>
                                            <option value="Amreli">Amreli</option>
                                            <option value="Bharuch">Bharuch</option>
                                            <option value="Bhavnagar">Bhavnagar</option>
                                            <option value="Bhuj">Bhuj</option>
                                            <option value="Dwarka">Dwarka</option>
                                            <option value="Gandhinagar">Gandhinagar</option>
                                            <option value="Godhra">Godhra</option>
                                            <option value="Jamnagar">Jamnagar</option>
                                            <option value="Junagadh">Junagadh</option>
                                            <option value="Kandla">Kandla</option>
                                            <option value="Khambhat">Khambhat</option>
                                            <option value="Kheda">Kheda</option>
                                            <option value="Mahesana">Mahesana</option>
                                            <option value="Morbi">Morbi</option>
                                            <option value="Nadiad">Nadiad</option>
                                            <option value="Navsari">Navsari</option>
                                            <option value="Okha">Okha</option>
                                            <option value="Palanpur">Palanpur</option>
                                            <option value="Patan">Patan</option>
                                            <option value="Porbandar">Porbandar</option>
                                            <option value="Rajkot">Rajkot</option>
                                            <option value="Surat">Surat</option>
                                            <option value="Surendranagar">Surendranagar</option>
                                            <option value="Valsad">Valsad</option>
                                            <option value="Veraval">Veraval</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" name="registration" style="background-color: #336699; border-color: #336699; padding: 14px; font-weight: 600; font-size: 16px; border-radius: 6px; display: block; width: 100%;">Create Account</button>
                            </form>
                            <div style="text-align: center; margin-top: 20px; font-size: 14px; color: #777;">
                                Already have an account? <a href="login.php" style="color: #336699; font-weight: 600;">Sign in here</a>
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
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg
            version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
                r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
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