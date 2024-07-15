<?php

require_once("classes/cls-page.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_page = new Page();
$conn = $obj_page->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}

if ($_POST['title'] == NULL) {
    $_SESSION['error'] = "Please enter the Title";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}

if ($_POST['content'] == NULL) {
    $_SESSION['error'] = "Please enter the Description";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}

if ($_POST['update_type'] == "add") {
    
    $insert_data['title'] = mysqli_real_escape_string($conn, $_POST['title']);
    $insert_data['content'] = mysqli_real_escape_string($conn, $_POST['content']);
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_page->insertPage($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Page information has been inserted successfully";
} else {
    //Generate SKU
    $page_id = base64_decode($_POST['page_id']);
    
    $condition = "`page_id` = '" . $page_id . "'";

    $update_data['title'] = mysqli_real_escape_string($conn, $_POST['title']);
    $update_data['content'] = mysqli_real_escape_string($conn, $_POST['content']);
    $update_data['status'] = $_POST['status'];
    $update_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_page->updatePage($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Page information has been updated successfully.";
}
header("Location:manage-page.php");
exit(0);
?>
