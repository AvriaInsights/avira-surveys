<?php
require_once("classes/cls-country.php");
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$obj_country = new Country();

$conn = $obj_country->getConnectionObj();

// Validations
if ($_POST['name'] == "") {
    $_SESSION['error'] = "Please enter the Country";
    header("Location:manage-country.php");
}

if ($_POST['update_type'] == "add") {
    $insert_data['shortname'] = mysqli_real_escape_string($conn, strtoupper($_POST['shortname']));
    $insert_data['name'] = mysqli_real_escape_string($conn, ucfirst($_POST['name']));
    $insert_data['phonecode'] = mysqli_real_escape_string($conn, $_POST['phonecode']);
    $obj_country->insertCountry($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Country information has been inserted successfully";
} else {
    $condition = "`country_id` = '" . base64_decode($_POST['country_id']) . "'";
    $update_data['shortname'] = mysqli_real_escape_string($conn, strtoupper($_POST['shortname']));
    $update_data['name'] = mysqli_real_escape_string($conn, ucfirst($_POST['name']));
    $update_data['phonecode'] = mysqli_real_escape_string($conn, $_POST['phonecode']);
    $obj_country->updateCountry($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Country information has been updated successfully.";
}
header("Location:manage-country.php");
exit(0);
?>
