<?php
require_once("classes/cls-blog.php");
$obj_blog = new Blog();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['blog_id'])) {
    $delete_ids = base64_decode($_GET['blog_id']);
}
$condition = "`blog_id` in(" . $delete_ids . ")";
$all_owner = $obj_blog->deleteBlog($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Blog information has been deleted successfully.";
header("location:manage-blog.php");
?>