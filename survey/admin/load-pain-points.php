<?php
require_once("classes/cls-report.php");

$obj_report = new Report();

$conn = $obj_report->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
$fields = "*";
$condition = "bundle_name <> ''";
$pain_details = $obj_report->getPainDetails($fields, $condition, '', '', 0);

$page_info = array();

foreach ($pain_details as $pain_detail) {
    
    $topic_data['pain_id'] ='<input type="checkbox" class="custom-control-input" id="keyCheck" name="keyCheck[]" value="'.$pain_detail['pain_id'].'">'.htmlspecialchars($pain_detail['pain_id']);
    $topic_data['bundle_name'] = htmlspecialchars($pain_detail['bundle_name']);
    $topic_data['pain_name'] = htmlspecialchars($pain_detail['pain_name']);
    $page_info[] = $topic_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($page_info),
    "iTotalDisplayRecords" => count($page_info),
    "aaData" => $page_info);
    

echo json_encode($results);


?>