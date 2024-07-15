<?php
require_once("classes/cls-enquiry.php");
$obj_enquiry = new Enquiry();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['enquiry_id'])) {
    $delete_ids = base64_decode($_GET['enquiry_id']);
}
$condition = "`enquiry_id` in(" . $delete_ids . ")";
$all_owner = $obj_enquiry->deleteEnquiry($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Enquiry information has been deleted successfully.";
header("location:manage-enquiry.php");
?>