<?php
require_once("classes/cls-category.php");

$obj_category = new Category();

$conn = $obj_category->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
$fields = "*";
$condition = "bundle_name <> ''";

$news_details = $obj_category->getNewsDetails($fields, $condition, '', '', 0);
//print_r($news_details); die();
//$report_info['data'] = array();
$page_info = array();

foreach ($news_details as $news_detail) {
    
    $topic_data['news_rep_id'] ='<input type="checkbox" class="custom-control-input" id="newsCheck" name="newsCheck[]" value="'.$news_detail['news_rep_id'].'">'. htmlspecialchars($news_detail['news_rep_id']);
    $topic_data['bundle_name'] = htmlspecialchars($news_detail['bundle_name']);
    $topic_data['title'] = htmlspecialchars($news_detail['title']);
    $topic_data['description'] = htmlspecialchars($news_detail['description']);

    $page_info[] = $topic_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($page_info),
    "iTotalDisplayRecords" => count($page_info),
    "aaData" => $page_info);
    

echo json_encode($results);


?>