<?php
require_once("classes/cls-request.php");
$obj_request = new Request();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['request_id'])) {
    $delete_ids = base64_decode($_GET['request_id']);
}
$condition = "`request_id` in(" . $delete_ids . ")";
$all_owner = $obj_request->deleteRequest($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Request information has been deleted successfully.";
header("location:manage-request.php");
?>