<?php
require_once("classes/cls-admin.php");
require_once('classes/cls-pagination.php');

$obj_admin = new Admin();
$obj_pagination = new Pagination();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "admin_id, CONCAT(f_name, ' ', lname) AS fullname, email_id, uname, role";
//$condition = "role = 'admin'";
$condition = "role != 'superadmin'";
$admin_details = $obj_admin->getAdminDetails($fields, $condition, '', '', 0);

foreach ($admin_details as $admin_detail) {
    $admin_data['admin_id'] = htmlspecialchars($admin_detail['admin_id']);
    $admin_data['fullname'] = htmlspecialchars($admin_detail['fullname']);
    $admin_data['email'] = htmlspecialchars($admin_detail['email_id']);
    $admin_data['uname'] = htmlspecialchars($admin_detail['uname']);
    $admin_data['role'] = htmlspecialchars($admin_detail['role']);
    $admin_data['action'] = '<a class="btn btn-success btn-circle" title="View Admin" href="view-admin.php?admin_id='. base64_encode($admin_detail['admin_id']).'"><i class="fa fa-list"></i></a>
                             <a class="btn btn-default btn-circle" title="Edit Admin" href="add-admin.php?admin_id='. base64_encode($admin_detail['admin_id']).'"><i class="fa fa-edit"></i></a>
                             <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-admin.php?admin_id='. base64_encode($admin_detail['admin_id']).'"><i class="fa fa-trash"></i></a>';
    
    $admin_info[] = $admin_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($admin_info),
    "iTotalDisplayRecords" => count($admin_info),
    "aaData" => $admin_info);

echo json_encode($results);


?>