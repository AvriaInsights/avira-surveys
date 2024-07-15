<?php
error_reporting(E_ALL);
require_once("classes/cls-faq.php");

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$obj_faq = new Faq();

$conn = $obj_faq->getConnectionObj();


if ($_POST['update_type'] == "edit") {
   
    $condition = "`faq_id` = '" . base64_decode($_POST['faq_id']) . "'";
    $update_data['faq_title'] = mysqli_real_escape_string($conn, ucfirst(trim($_POST['question'])));
    $update_data['faq_content'] = mysqli_real_escape_string($conn, ucfirst(trim($_POST['answer'])));
    $update_data['status'] = mysqli_real_escape_string($conn, $_POST['status']);
    $update_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_faq->updateFAQ($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> FAQ has been updated successfully.";
}
header("Location:manage-faq.php?report_id='". base64_encode($_POST['report_id'])."'");
exit(0);
?>
