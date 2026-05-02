<?php
include './common/class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);

    $query = mysqli_query($connection, "INSERT INTO tbl_contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')") or die(mysqli_error($connection));

    if ($query) {
        header("Location: contact.php?msg=contact_success");
        exit();
    } else {
        header("Location: contact.php?msg=contact_error");
        exit();
    }
} else {
    header("Location: contact.php");
    exit();
}
?>
