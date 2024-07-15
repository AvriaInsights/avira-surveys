<?php
require_once("classes/cls-user.php");
$obj_user = new User();

// check for email id
if (isset($_POST['email']) && $_POST['email'] != "") {
    if (isset($_POST['old_email'])) {
        if ($_POST['email'] == $_POST['old_email']) {
            echo "true";
            die();
        }
    }
    $condition = "`email` = '" . $_POST['email'] . "'";
    $user_details = $obj_user->getUserDetails('', $condition, '', '', 0);

    if (isset($user_details) && count($user_details)) {
        echo "false";
    } else {
        echo "true";
    }
}
?>