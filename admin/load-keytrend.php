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
                    
$key_details = $obj_category->getKeyDetails('', $condition, '', '', 0);
$report_info['data'] = array();
$page_info = array();

foreach ($key_details as $key_detail) {
    
    
    $topic_data['key_id'] ='<input type="checkbox" class="custom-control-input" id="keyCheck" name="keyCheck[]" value="'.$key_detail['key_id'].'">'.htmlspecialchars($key_detail['key_id']);
    $topic_data['bundle_name'] = htmlspecialchars($key_detail['bundle_name']);
     $topic_data['key_trend'] =  htmlspecialchars($key_detail['key_trend']);
    $topic_data['impact'] =  htmlspecialchars($key_detail['impact']);
    $topic_data['direction'] = htmlspecialchars($key_detail['direction']);
//     $topic_data['action'] = '<a class="btn btn-success btn-circle" title="View Report" href="view-topic.php?key_id='. base64_encode($key_detail['key_id']).'"><i class="fa fa-list"></i></a>
//                               <a class="btn btn-default btn-circle" title="Edit Report" href="add-topic.php?key_id='. base64_encode($key_detail['key_id']).'"><i class="fa fa-edit"></i></a>
//   <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-keytrend.php?key_id='. base64_encode($key_detail['key_id']).'"><i class="fa fa-trash"></i></a>';

    
    $page_info[] = $topic_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($page_info),
    "iTotalDisplayRecords" => count($page_info),
    "aaData" => $page_info);
    

echo json_encode($results);


?>