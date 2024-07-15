<?php
require_once("classes/cls-report.php");
$obj_report = new Report();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['report_id'])) {
    $delete_ids = base64_decode($_GET['report_id']);
}
$condition = "`report_id` in(" . $delete_ids . ")";
$all_owner = $obj_report->deleteReport($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Report information has been deleted successfully.";
header("location:manage-report.php");
?>