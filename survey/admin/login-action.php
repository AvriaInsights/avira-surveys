<?php

require_once("classes/cls-admin.php");

$obj_admin = new Admin();

$conn = $obj_admin->getConnectionObj();

if($_POST['uname'] == NULL) {
    $_SESSION['error'] = "Please enter the Username";
    header("Location:login.php");
} 

if($_POST['password'] == NULL) {
    $_SESSION['error'] = "Please enter the Password";
    header("Location:login.php");
} 

if ($_POST['btn_submit'] == 'Login') {
    $uname = mysqli_real_escape_string($conn, trim($_POST['uname']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $enc_password = base64_encode($password);
    $condition = "uname = '" . $uname . "' AND password ='" . $enc_password . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);
    if (count($admin_details) > 0) {
        $admin_detail = end($admin_details);
        if ($admin_detail['status'] == "Inactive") {
            $_SESSION['error'] = "<strong>Sorry</strong> Your Account is Temporarily Blocked.";
            header("location:login.php");
        } else {
            if ($_POST['remember'] == "on") {
                setcookie("alxa_uname", $_POST['uname'], time() + 7200);
                setcookie("alxa_password", $_POST['password'], time() + 7200);
            }
            $_SESSION['ifg_admin'] = $admin_detail;
            header("location:index.php");
        }
    } else {
        $_SESSION['error'] = "<strong>Sorry</strong> Invalid username or password.";
        header("location:login.php");
    }
} else {
    $_SESSION['error'] = "<strong>Sorry</strong> Something went wrong. Please try again";
    header("location:login.php");
}
?>