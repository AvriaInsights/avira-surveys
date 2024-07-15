<?php
require_once("classes/cls-city.php");
$obj_city = new City();
if (isset($_POST) && !empty($_POST)) {
    $condition = "`state_id` = '" . $_POST['state_id'] . "'";
    $city_details = $obj_city->getCityDetails($fields, $condition, $order_by, $limit, 0);
    if (isset($city_details) && !empty($city_details)) {
        echo "<option value=''>Select City</option>";
        foreach ($city_details as $city_detail) {
            echo "<option value='" . $city_detail['city_id'] . "'>" . $city_detail['name'] . "</option>";
        }
    } else {
        echo "<option value=''>Select City</option>";
    }
} else {
    echo "<option value=''>Select City</option>";
}
?>