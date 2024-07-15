<?php
require_once("classes/cls-client-logo.php");

$obj_logo = new Logo();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "logo_id, logo, client_name";
$condition = "";
$logo_details = $obj_logo->getLogoDetails($fields, $condition, '', '', 0);
$logo_info = array();

foreach ($logo_details as $logo_detail) {
    $logo_data['logo_id'] = htmlspecialchars($logo_detail['logo_id']);
    $logo_data['logo'] =  '<img src="'. htmlspecialchars($logo_detail['logo']).'" height="150" width="150" class="img-thumbnail" >';
    $logo_data['client_name'] =  htmlspecialchars($logo_detail['client_name']);
    $logo_data['action'] = '<a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-client-logo.php?logo_id='. base64_encode($logo_detail['logo_id']).'"><i class="fa fa-trash"></i></a>';
    $logo_info[] = $logo_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($logo_info),
    "iTotalDisplayRecords" => count($logo_info),
    "aaData" => $logo_info);

echo json_encode($results);


?>