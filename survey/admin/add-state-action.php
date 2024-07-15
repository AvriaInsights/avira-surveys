<?php
require_once("classes/cls-state.php");
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$obj_state = new State();

$conn = $obj_state->getConnectionObj();

// Validations
if ($_POST['name'] == "") {
    $_SESSION['error'] = "Please enter the State";
    header("Location:manage-state.php");
}

if ($_POST['update_type'] == "add") {
    $insert_data['name'] = mysqli_real_escape_string($conn, ucfirst($_POST['name']));
    $insert_data['country_id'] = mysqli_real_escape_string($conn, $_POST['country_id']);
    $obj_state->insertState($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> State information has been inserted successfully";
} else {
    $condition = "`state_id` = '" . base64_decode($_POST['state_id']) . "'";
    $update_data['name'] = mysqli_real_escape_string($conn, ucfirst($_POST['name']));
    $update_data['country_id'] = mysqli_real_escape_string($conn, $_POST['country_id']);
    $obj_state->updateState($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> State information has been updated successfully.";
}
header("Location:manage-state.php");
exit(0);
?>
