<?php
require_once("classes/cls-admin.php");
$obj_admin = new Admin();
$user_id = $_SESSION['ifg_admin']['admin_id'];
if($user_id != "")
{
$conn = $obj_admin->getConnectionObj();
$condition = "`admin_id` = '" . $user_id . "'";
$update_data['user_status'] = mysqli_real_escape_string($conn,"Offline");
$obj_admin->updateAdmin($update_data, $condition, 0);
}
session_start();
unset($_SESSION);
session_destroy();
header("location:login");
?>