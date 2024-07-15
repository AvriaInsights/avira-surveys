<?php

require_once("classes/cls-press.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_press = new Press();
$conn = $obj_press->getConnectionObj();

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

$slug = $_POST['slug'];
$slug = str_replace(" ", "-", $slug);
$slug = strtolower($slug);

if ($_POST['update_type'] == "add") {
    
    $insert_data['title'] = mysqli_real_escape_string($conn, utf8_encode(preg_replace('/\s+/', ' ', $_POST['title'])));
    $insert_data['description'] = mysqli_real_escape_string($conn, utf8_encode(preg_replace('/\s+/', ' ', $_POST['description'])));
    $insert_data['category_id'] = mysqli_real_escape_string($conn, $_POST['category_id']);
    $insert_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $insert_data['meta_title'] = mysqli_real_escape_string($conn, utf8_encode(preg_replace('/\s+/', ' ', $_POST['meta_title'])));
    $insert_data['meta_keyword'] = mysqli_real_escape_string($conn, utf8_encode(preg_replace('/\s+/', ' ', $_POST['meta_keyword'])));
    $insert_data['meta_description'] = mysqli_real_escape_string($conn, utf8_encode(preg_replace('/\s+/', ' ', $_POST['meta_description'])));
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_press->insertPress($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Press information has been inserted successfully";
} else {
    //Generate SKU
    $press_id = base64_decode($_POST['press_id']);
    
    $condition = "`press_id` = '" . $press_id . "'";

    $update_data['title'] = mysqli_real_escape_string($conn, utf8_encode(preg_replace('/\s+/', ' ', $_POST['title'])));
    $update_data['description'] = mysqli_real_escape_string($conn, utf8_encode(preg_replace('/\s+/', ' ', $_POST['description'])));
    $update_data['category_id'] = mysqli_real_escape_string($conn, $_POST['category_id']);
    $update_data['slug'] = mysqli_real_escape_string($conn, $_POST['slug']);
    $update_data['meta_title'] = mysqli_real_escape_string($conn, utf8_encode(preg_replace('/\s+/', ' ', $_POST['meta_title'])));
    $update_data['meta_keyword'] = mysqli_real_escape_string($conn, utf8_encode(preg_replace('/\s+/', ' ', $_POST['meta_keyword'])));
    $update_data['meta_description'] = mysqli_real_escape_string($conn, utf8_encode(preg_replace('/\s+/', ' ', $_POST['meta_description'])));
    $update_data['status'] = $_POST['status'];
    $update_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_press->updatePress($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Press information has been updated successfully.";
}
header("Location:manage-press.php");
exit(0);
?>
