<?php
require_once("classes/cls-press.php");
$obj_press = new Press();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['press_id'])) {
    $delete_ids = base64_decode($_GET['press_id']);
}
$condition = "`press_id` in(" . $delete_ids . ")";
$all_owner = $obj_press->deletePress($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Press information has been deleted successfully.";
header("location:manage-press.php");
?>