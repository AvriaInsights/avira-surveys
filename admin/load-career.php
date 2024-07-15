<?php
require_once("classes/cls-career.php");

$obj_page = new Career();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "career_id, position_name, status";
$condition = "";
$page_details = $obj_page->getPageDetails($fields, $condition, '', '', 0);
$page_info = array();

foreach ($page_details as $page_detail) {
    $page_data['career_id'] = htmlspecialchars($page_detail['career_id']);
    $page_data['position_name'] = htmlspecialchars($page_detail['position_name']);
    $page_data['status'] = htmlspecialchars($page_detail['status']);
    $page_data['action'] = '<a class="btn btn-success btn-circle" title="View Page" href="view-career.php?career_id='. base64_encode($page_detail['career_id']).'"><i class="fa fa-list"></i></a>
                            <a class="btn btn-default btn-circle" title="Edit Page" href="add-opening.php?career_id='. base64_encode($page_detail['career_id']).'"><i class="fa fa-edit"></i></a>';
    
    $page_info[] = $page_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($page_info),
    "iTotalDisplayRecords" => count($page_info),
    "aaData" => $page_info);

echo json_encode($results);


?>