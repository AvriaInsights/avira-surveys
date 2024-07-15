<?php
require_once("classes/cls-press.php");

$obj_press = new Press();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "press_id, created_at, title, status, slug";
$condition = "";
$press_details = $obj_press->getPressDetails($fields, $condition, '', '', 0);
$press_info = array();

foreach ($press_details as $press_detail) {
    $press_data['press_id'] = htmlspecialchars($press_detail['press_id']);
    $press_data['title'] = htmlspecialchars($press_detail['title']);
    $press_data['created_at'] = htmlspecialchars(date("M j, Y H:i A", strtotime($press_detail['created_at'])));
    $press_data['status'] = htmlspecialchars($press_detail['status']);
    $press_data['action'] = '<a class="btn btn-success btn-circle" target="_blank" title="View Press Release List" href="'.SITEPATH.'/press-release/'.$press_detail['slug'].'"><i class="fa fa-list"></i></a>
                             <a class="btn btn-default btn-circle" title="Edit Press" href="add-press.php?press_id='. base64_encode($press_detail['press_id']).'"><i class="fa fa-edit"></i></a>
                             <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-press.php?press_id='. base64_encode($press_detail['press_id']).'"><i class="fa fa-trash"></i></a>';
    
    $press_info[] = $press_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($press_info),
    "iTotalDisplayRecords" => count($press_info),
    "aaData" => $press_info);

echo json_encode($results);


?>