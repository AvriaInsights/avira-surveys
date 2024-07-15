<?php
require_once("classes/cls-user.php");
$obj_user = new User();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['user_id'])) {
    $delete_ids = base64_decode($_GET['user_id']);
}
$condition = "`user_id` in(" . $delete_ids . ")";
$all_owner = $obj_user->deleteUser($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> User information has been deleted successfully.";
header("location:manage-user.php");
?>