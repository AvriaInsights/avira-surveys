<?php
require_once("classes/cls-city.php");

$obj_city = new City();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "tbl_city.city_id, tbl_country.name AS country, tbl_state.name AS state, tbl_city.name";
$condition = "tbl_city.state_id = tbl_state.state_id AND tbl_state.country_id = tbl_country.country_id";
$city_details = $obj_city->getCityStateCountryDetails($fields, $condition, '', '', 0);
$city_info = array();

foreach ($city_details as $city_detail) {
    $city_data['city_id'] = htmlspecialchars($city_detail['city_id']);
    $city_data['country'] = htmlspecialchars($city_detail['country']);
    $city_data['state'] = htmlspecialchars($city_detail['state']);
    $city_data['name'] = htmlspecialchars($city_detail['name']);
    $city_data['action'] = '<a class="btn btn-default btn-circle" title="Edit City" href="add-city.php?city_id='. base64_encode($city_detail['city_id']).'"><i class="fa fa-edit"></i></a>';
    $city_info[] = $city_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($city_info),
    "iTotalDisplayRecords" => count($city_info),
    "aaData" => $city_info);

echo json_encode($results);


?>