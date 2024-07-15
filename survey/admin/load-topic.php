<?php
require_once("classes/cls-category.php");

$obj_category = new Category();

$conn = $obj_category->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
$fields = "*";
$condition = "bundle_name <> ''";
/*
if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != "") {
    $condition .= " AND category_id = '" . $_REQUEST['category_id'] . "'";
}
*/
 
$topic_details = $obj_category->getTopicDetails('', $condition, '', '', 0);
$report_info['data'] = array();
$page_info = array();

foreach ($topic_details as $topic_detail) {
    
    
    $topic_data['bundle_id'] ='<input type="checkbox" class="custom-control-input" id="topicCheck" name="topicCheck[]" value="'.$topic_detail['bundle_id'].'">'.htmlspecialchars($topic_detail['bundle_id']);
    $topic_data['bundle_name'] = htmlspecialchars($topic_detail['bundle_name']);
    $topic_data['bundle_overview'] =  htmlspecialchars($topic_detail['bundle_overview']);
    $topic_data['market_data'] =  htmlspecialchars($topic_detail['market_data']);
    $topic_data['status'] = htmlspecialchars($topic_detail['status']);
    // $topic_data['action'] = '<a class="btn btn-success btn-circle" title="View Report" href="view-topic.php?bundle_id='. base64_encode($topic_detail['bundle_id']).'"><i class="fa fa-list"></i></a>
    //                           <a class="btn btn-default btn-circle" title="Edit Report" href="add-topic.php?bundle_id='. base64_encode($topic_detail['bundle_id']).'"><i class="fa fa-edit"></i></a>';
   
    $page_info[] = $topic_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($page_info),
    "iTotalDisplayRecords" => count($page_info),
    "aaData" => $page_info);
    

echo json_encode($results);


?>