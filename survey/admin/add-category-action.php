<?php

error_reporting(E_ALL);
require_once("classes/cls-category.php");
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$obj_category = new Category();

$conn = $obj_category->getConnectionObj();

// Validations
if ($_POST['title'] == "") {
    $_SESSION['error'] = "Please enter the Title";
    header("Location:manage-category.php");
}

if ($_POST['update_type'] == "add") {
    $insert_data['title'] = trim(ucfirst($_POST['title']));
    $insert_data['shortcode'] = mysqli_real_escape_string($conn, strtoupper($_POST['shortcode']));
    $insert_data['status'] = mysqli_real_escape_string($conn, trim($_POST['status']));
    $insert_data['featured'] = mysqli_real_escape_string($conn, trim($_POST['featured']));
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_category->insertCategory($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Category information has been inserted successfully";
} else {
    $condition = "`category_id` = '" . base64_decode($_POST['category_id']) . "'";
    $update_data['title'] = trim(ucfirst($_POST['title']));
    $update_data['shortcode'] = mysqli_real_escape_string($conn, strtoupper($_POST['shortcode']));
    $update_data['status'] = mysqli_real_escape_string($conn, trim($_POST['status']));
    $update_data['featured'] = mysqli_real_escape_string($conn, trim($_POST['featured']));
    $update_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_category->updateCategory($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Category information has been updated successfully.";
}
header("Location:manage-category.php");
exit(0);
?>
