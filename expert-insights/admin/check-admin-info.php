<?php
require_once("classes/cls-admin.php");
$obj_admin = new Admin();

// check for email id
if (isset($_POST['email']) && $_POST['email'] != "") {
    if (isset($_POST['old_email'])) {
        if ($_POST['email'] == $_POST['old_email']) {
            echo "true";
            die();
        }
    }
    $condition = "`email_id` = '" . $_POST['email'] . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);

    if (isset($admin_details) && count($admin_details)) {
        echo "false";
    } else {
        echo "true";
    }
}

// check for username
if (isset($_POST['uname']) && !empty($_POST['uname'])) {
    if (isset($_POST['old_uname'])) {
        if ($_POST['uname'] == $_POST['old_uname']) {
            echo "true";
            die();
        }
    }
    $condition = "`uname` = '" . $_POST['uname'] . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);

    if (isset($admin_details) && count($admin_details)) {
        echo "false";
    } else {
        echo "true";
    }
}
?>