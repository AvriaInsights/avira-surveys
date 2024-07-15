<?php

require_once("classes/cls-white.php");
require_once("classes/cls-category.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_report = new White();
$obj_category = new Category();
$conn = $obj_report->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}

if ($_POST['category_id'] == NULL) {
    $_SESSION['error'] = "Please select the Category";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}

if ($_POST['title'] == NULL) {
    $_SESSION['error'] = "Please enter the Title";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}


if ($_POST['description'] == NULL) {
    $_SESSION['error'] = "Please enter the Description";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}
$condition = "`category_id` = '".$_POST['category_id']."'";
$shortcode_details = $obj_category->getCategoryDetails("`shortcode`", $condition, '', 1, 0);
$shortcode_detail = end($shortcode_details);
$shortcode = $shortcode_detail['shortcode'];

$title = $obj_report->cleanOutput($_POST['title']);
$slug = $obj_report->cleanOutput($_POST['slug']);
$slug = str_replace(" ", "-", $slug);
$slug = strtolower($slug);
$description = $obj_report->cleanOutput($_POST['description']);
$paper_content = $obj_report->cleanOutput($_POST['paper_content']);

if ($_POST['update_type'] == "add")
{
    
    $insert_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $insert_data['title'] = mysqli_real_escape_string($conn, $title);
    $insert_data['description'] = mysqli_real_escape_string($conn, $description);
    $insert_data['paper_content'] = mysqli_real_escape_string($conn, $paper_content);
    $insert_data['category_id'] = mysqli_real_escape_string($conn, $_POST['category_id']);
    $insert_data['author_name'] = mysqli_real_escape_string($conn, $_POST['author_name']);
    $insert_data['author_designation'] = mysqli_real_escape_string($conn, $_POST['author_designation']);
    $insert_data['published_date'] = mysqli_real_escape_string($conn, $_POST['published_date']);
    $insert_data['featured'] = $_POST['featured'];
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_report->insertReport($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> White paper information has been inserted successfully";
} else {
    //Generate SKU
    $paper_id = base64_decode($_POST['paper_id']);
    $update_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $update_data['title'] = mysqli_real_escape_string($conn, $title);
    $update_data['description'] = mysqli_real_escape_string($conn, $description);
    $update_data['paper_content'] = mysqli_real_escape_string($conn, $paper_content);
    $update_data['category_id'] = mysqli_real_escape_string($conn, $_POST['category_id']);
    $update_data['author_name'] = mysqli_real_escape_string($conn, $_POST['author_name']);
    $update_data['author_designation'] = mysqli_real_escape_string($conn, $_POST['author_designation']);
    $update_data['published_date'] = mysqli_real_escape_string($conn, $_POST['published_date']);
    $update_data['featured'] = $_POST['featured'];
    $update_data['status'] = $_POST['status'];
    $update_data['created_at'] = date("Y-m-d H:i:s");
    $update_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_report->updateReport($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Report information has been updated successfully.";
}
header("Location:manage-white-paper.php");
exit(0);
?>
