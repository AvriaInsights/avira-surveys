<?php
require_once("classes/cls-country.php");

$obj_country = new Country();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "country_id, name";
$condition = "";
$country_details = $obj_country->getCountryDetails($fields, $condition, '', '', 0);
$country_info = array();

foreach ($country_details as $country_detail) {
    $country_data['country_id'] = htmlspecialchars($country_detail['country_id']);
    $country_data['name'] = htmlspecialchars($country_detail['name']);
    $country_data['action'] = '<a class="btn btn-default btn-circle" title="Edit Country" href="add-country.php?country_id='. base64_encode($country_detail['country_id']).'"><i class="fa fa-edit"></i></a>';
    $country_info[] = $country_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($country_info),
    "iTotalDisplayRecords" => count($country_info),
    "aaData" => $country_info);

echo json_encode($results);


?>