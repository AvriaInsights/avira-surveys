<?php
require_once("classes/cls-author.php");
$obj_author = new Author();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['author_id'])) {
    $delete_ids = base64_decode($_GET['author_id']);
}
$condition = "`author_id` in(" . $delete_ids . ")";
$all_owner = $obj_author->deleteAuthor($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Author information has been deleted successfully.";
header("location:manage-author.php");
?>