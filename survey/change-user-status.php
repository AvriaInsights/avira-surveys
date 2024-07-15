<?php
require_once("classes/cls-user.php");
$update_data = array("status" => $_POST['status']);
$condition = "user_id = '" . $_POST['user_id'] . "'";
$obj_user = new User();

$update_status = $obj_user->updateUser($update_data, $condition, 0);

if (!$update_status) {
    $msg = array("error" => 1, "error_message" => "Error in changing Coupon status, please try again.");
} else {
    $msg = array("error" => 0, "error_message" => "0");
}
echo json_encode($msg);
?>