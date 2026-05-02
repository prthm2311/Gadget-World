<?php
include './common/class.php';
session_destroy();
echo "<script>window.location='index.php?msg=logout';</script>";
