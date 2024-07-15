<?php
require_once("classes/cls-testimonial.php");
$obj_testimonial = new Testimonial();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_GET['testimonial_id'])) {
    $delete_ids = base64_decode($_GET['testimonial_id']);
}
$condition = "`testimonial_id` in(" . $delete_ids . ")";
$all_owner = $obj_testimonial->deleteTestimonial($condition, 0);
$_SESSION['success'] = "<strong>Congratulations</strong> Testimonial information has been deleted successfully.";
header("location:manage-testimonial.php");
?>