<?php
require_once("classes/cls-order.php");
$obj_order = new Order();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['order_id'])) {
    $delete_ids = base64_decode($_GET['order_id']);
}
$condition = "`order_id` in(" . $delete_ids . ")";
$all_owner = $obj_order->deleteOrder($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Order information has been deleted successfully.";
header("location:manage-order.php");
?>