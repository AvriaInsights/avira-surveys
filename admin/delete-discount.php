<?php
require_once("classes/cls-discount.php");
$obj_discount = new Discount();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['discount_id'])) {
    $delete_ids = base64_decode($_GET['discount_id']);
}
$condition = "`discount_id` in(" . $delete_ids . ")";
$all_owner = $obj_discount->deleteDiscount($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Discount information has been deleted successfully.";
header("location:manage-discount.php");
?>