<?php
error_reporting(E_ALL);
require_once("classes/cls-author.php");
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$obj_author = new Author();

$conn = $obj_author->getConnectionObj();

// Validations
if ($_POST['fullname'] == "") {
    $_SESSION['error'] = "Please enter the Full Name";
    header("Location:manage-author.php");
}

if ($_POST['update_type'] == "add") {
    $insert_data['fullname'] = mysqli_real_escape_string($conn, ucfirst($_POST['fullname']));
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_author->insertAuthor($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Author information has been inserted successfully";
} else {
    $condition = "`author_id` = '" . base64_decode($_POST['author_id']) . "'";
    $update_data['fullname'] = mysqli_real_escape_string($conn, ucfirst($_POST['fullname']));
    $update_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_author->updateAuthor($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Author information has been updated successfully.";
}
header("Location:manage-author.php");
exit(0);
?>
