<?php
require_once("classes/cls-faq.php");
$obj_faq = new Faq();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['faq_id'])) {
    $delete_ids = base64_decode($_GET['faq_id']);
}
$condition = "`faq_id` in(" . $delete_ids . ")";
$all_owner = $obj_faq->deleteFAQ($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> FAQ has been deleted successfully.";
header("location:manage-faq.php");
?>