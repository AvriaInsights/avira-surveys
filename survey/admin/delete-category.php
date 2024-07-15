<?php
require_once("classes/cls-category.php");
$obj_category = new Category();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['category_id'])) {
    $delete_ids = base64_decode($_GET['category_id']);
}
$condition = "`category_id` in(" . $delete_ids . ")";
$all_owner = $obj_category->deleteCategory($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Category information has been deleted successfully.";
header("location:manage-category.php");
?>