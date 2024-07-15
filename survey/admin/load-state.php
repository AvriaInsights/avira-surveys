<?php
require_once("classes/cls-state.php");

$obj_state = new State();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "tbl_state.state_id, tbl_country.name as country, tbl_state.name";
$condition = "tbl_state.country_id = tbl_country.country_id";
$state_details = $obj_state->getStateCountryDetails($fields, $condition, '', '', 0);
$state_info = array();

foreach ($state_details as $state_detail) {
    $state_data['state_id'] = htmlspecialchars($state_detail['state_id']);
    $state_data['country'] = htmlspecialchars($state_detail['country']);
    $state_data['name'] = htmlspecialchars($state_detail['name']);
    $state_data['action'] = '<a class="btn btn-default btn-circle" title="Edit State" href="add-state.php?state_id='. base64_encode($state_detail['state_id']).'"><i class="fa fa-edit"></i></a>';
    $state_info[] = $state_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($state_info),
    "iTotalDisplayRecords" => count($state_info),
    "aaData" => $state_info);

echo json_encode($results);


?>