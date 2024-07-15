<?php
require_once("survey/classes/cls-user.php");
$obj_user = new User();
// check for email id
if (isset($_GET['email']) && $_GET['email'] != "") 
{
   /* if (isset($_GET['old_email'])) {
        if ($_GET['email'] == $_GET['old_email']) {
            echo "true";
            die();
        }
    }*/
    $condition = "`email` = '" . $_GET['email'] . "'";
    $user_details = $obj_user->getUserclientDetails('', $condition, '', '', 0);

    if (isset($user_details) && count($user_details)) {
        echo "false";
    } else {
        echo "true";
    }
}

if (isset($_GET['username']) && $_GET['username'] != "") 
{
    $condition = "`uname` = '" . $_GET['username'] . "'";
    $user_details_username = $obj_user->getUserclientDetails('', $condition, '', '', 0);

    if (isset($user_details_username) && count($user_details_username)) {
        echo "false";
    } else {
        echo "true";
    }
}

?>