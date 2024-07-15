<?php

require_once("classes/cls-career.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_page = new Career();
$conn = $obj_page->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}

if ($_POST['position_name'] == NULL) {
    $_SESSION['error'] = "Please enter the Position Name";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}

if ($_POST['job_description'] == NULL) {
    $_SESSION['error'] = "Please enter the Job Description";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}

if ($_POST['update_type'] == "add") {
    
    $insert_data['position_name'] = mysqli_real_escape_string($conn, $_POST['position_name']);
    $insert_data['experience'] = mysqli_real_escape_string($conn, $_POST['experience']);
    $insert_data['qualification'] = mysqli_real_escape_string($conn, $_POST['qualification']);
    $insert_data['location'] = mysqli_real_escape_string($conn, $_POST['location']);
    $insert_data['rol_category'] = mysqli_real_escape_string($conn, $_POST['rol_category']);
    $insert_data['job_description'] = mysqli_real_escape_string($conn, $_POST['job_description']);
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_page->insertPage($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Career information has been inserted successfully";
} else {
    //Generate SKU
    $career_id = base64_decode($_POST['career_id']);
    
    $condition = "`career_id` = '" . $career_id . "'";
    
    $update_data['position_name'] = mysqli_real_escape_string($conn, $_POST['position_name']);
    $update_data['experience'] = mysqli_real_escape_string($conn, $_POST['experience']);
    $update_data['qualification'] = mysqli_real_escape_string($conn, $_POST['qualification']);
    $update_data['location'] = mysqli_real_escape_string($conn, $_POST['location']);
    $update_data['rol_category'] = mysqli_real_escape_string($conn, $_POST['rol_category']);
    $update_data['job_description'] = mysqli_real_escape_string($conn, $_POST['job_description']);
    $update_data['status'] = $_POST['status'];
    $update_data['updated_at'] = date("Y-m-d H:i:s");
    

    $obj_page->updatePage($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Career information has been updated successfully.";
}
header("Location:manage-careers.php");
exit(0);
?>
