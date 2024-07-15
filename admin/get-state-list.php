<?php
require_once("classes/cls-state.php");
$obj_state = new State();
if (isset($_POST) && !empty($_POST)) {
    $condition = "`country_id` = '" . $_POST['country_id'] . "'";
    $state_details = $obj_state->getStateDetails($fields, $condition, $order_by, $limit, 0);
    if (isset($state_details) && !empty($state_details)) {
        echo "<option value=''>Select State</option>";
        foreach ($state_details as $state_detail) {
            echo "<option value='" . $state_detail['state_id'] . "'>" . $state_detail['name'] . "</option>";
        }
    } else {
        echo "<option value=''>Select State</option>";
    }
} else {
    echo "<option value=''>Select State</option>";
}
?>