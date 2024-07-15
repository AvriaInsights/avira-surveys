<?php
require_once("classes/cls-page.php");

$obj_page = new Page();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "page_id, title, status";
$condition = "";
$page_details = $obj_page->getPageDetails($fields, $condition, '', '', 0);
$page_info = array();

foreach ($page_details as $page_detail) {
    $page_data['page_id'] = htmlspecialchars($page_detail['page_id']);
    $page_data['title'] = htmlspecialchars($page_detail['title']);
    $page_data['status'] = htmlspecialchars($page_detail['status']);
    $page_data['action'] = '<a class="btn btn-success btn-circle" title="View Page" href="view-page.php?page_id='. base64_encode($page_detail['page_id']).'"><i class="fa fa-list"></i></a>
                             <a class="btn btn-default btn-circle" title="Edit Page" href="add-page.php?page_id='. base64_encode($page_detail['page_id']).'"><i class="fa fa-edit"></i></a>';
    
    $page_info[] = $page_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($page_info),
    "iTotalDisplayRecords" => count($page_info),
    "aaData" => $page_info);

echo json_encode($results);


?>