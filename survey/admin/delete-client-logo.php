<?php
require_once("classes/cls-client-logo.php");
$obj_logo = new Logo();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['logo_id'])) {
    $delete_ids = base64_decode($_GET['logo_id']);
}
$condition = "`logo_id` in(" . $delete_ids . ")";
$all_owner = $obj_logo->deleteLogo($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Client Logo has been deleted successfully.";
header("location:manage-client-logo.php");
?>