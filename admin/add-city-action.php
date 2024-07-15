<?php
require_once("classes/cls-city.php");
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$obj_city = new City();

$conn = $obj_city->getConnectionObj();

// Validations
if ($_POST['name'] == "") {
    $_SESSION['error'] = "Please enter the City";
    header("Location:manage-city.php");
}

if ($_POST['update_type'] == "add") {
    $insert_data['name'] = mysqli_real_escape_string($conn, ucfirst($_POST['name']));
    $insert_data['state_id'] = mysqli_real_escape_string($conn, $_POST['state_id']);
    $obj_city->insertCity($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> City information has been inserted successfully";
} else {
    $condition = "`city_id` = '" . base64_decode($_POST['city_id']) . "'";
    $update_data['name'] = mysqli_real_escape_string($conn, ucfirst($_POST['name']));
    $update_data['state_id'] = mysqli_real_escape_string($conn, $_POST['state_id']);
    $obj_city->updateCity($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> City information has been updated successfully.";
}
header("Location:manage-city.php");
exit(0);
?>
