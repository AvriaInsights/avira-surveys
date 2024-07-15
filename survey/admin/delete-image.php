<?php
require_once("classes/cls-image.php");
$obj_image = new Image();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['image_id'])) {
    $delete_ids = base64_decode($_GET['image_id']);
}
$condition = "`image_id` in(" . $delete_ids . ")";
$all_owner = $obj_image->deleteImage($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Image has been deleted successfully.";
header("location:manage-image.php");
?>