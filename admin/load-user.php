<?php
require_once("classes/cls-user.php");

$obj_user = new User();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "user_id, CONCAT(fname, ' ', lname) AS fullname, email, phone, status";
$condition = "";
$user_details = $obj_user->getUserDetails($fields, $condition, '', '', 0);
$user_info = array();

foreach ($user_details as $user_detail) {
    $user_data['user_id'] = htmlspecialchars($user_detail['user_id']);
    $user_data['fullname'] = htmlspecialchars($user_detail['fullname']);
    $user_data['email'] = htmlspecialchars($user_detail['email']);
    $user_data['phone'] = htmlspecialchars($user_detail['phone']);
    $user_data['status'] = htmlspecialchars($user_detail['status']);
    $user_data['action'] = '<a class="btn btn-success btn-circle" title="View User" href="view-user.php?user_id='. base64_encode($user_detail['user_id']).'"><i class="fa fa-list"></i></a>
                             <a class="btn btn-default btn-circle" title="Edit User" href="add-user.php?user_id='. base64_encode($user_detail['user_id']).'"><i class="fa fa-edit"></i></a>
                             <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-user.php?user_id='. base64_encode($user_detail['user_id']).'"><i class="fa fa-trash"></i></a>';
    
    $user_info[] = $user_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($user_info),
    "iTotalDisplayRecords" => count($user_info),
    "aaData" => $user_info);

echo json_encode($results);


?>