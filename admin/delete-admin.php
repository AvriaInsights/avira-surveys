<?php
require_once("classes/cls-admin.php");
$obj_admin = new Admin();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['admin_id'])) {
    $delete_ids = base64_decode($_GET['admin_id']);
}
$condition = "`admin_id` in(" . $delete_ids . ")";
$all_owner = $obj_admin->deleteAdmin($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Admin information has been deleted successfully.";
header("location:manage-admin.php");
?>