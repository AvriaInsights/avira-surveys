<?php

require_once("classes/cls-report.php");
require_once("classes/cls-category.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_report = new Report();
$obj_category = new Category();
$conn = $obj_report->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}


$insData = $_POST;


//print_r($insData);

$cnt= count($insData)-1;
$half=$cnt/2;
$reportid=base64_decode($insData['report_id']);
$insert_data['report_id'] = mysqli_real_escape_string($conn, $reportid);
for($i=1;$i<=$half;$i++)
{
   $question=$insData['title_'.$i];
   $answer=$insData['content_'.$i];
   $insert_data['faq_title'] = mysqli_real_escape_string($conn, $question);
   $insert_data['faq_content'] = mysqli_real_escape_string($conn, $answer);
   $insert_data['status'] = mysqli_real_escape_string($conn, 'Active');
   $insert_data['created_at'] = mysqli_real_escape_string($conn, date("Y-m-d H:i:s"));
   $insert_data['updated_at'] = mysqli_real_escape_string($conn, date("Y-m-d H:i:s"));
   $obj_report->insertReportFAQ($insert_data, 0);
}

$_SESSION['success'] = "<strong>Congratulations</strong> Report FAQ information has been inserted successfully";
header("Location:manage-report.php");
exit(0);
?>
