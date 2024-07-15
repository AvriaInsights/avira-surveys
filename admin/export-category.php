<?php
require_once("classes/cls-category.php");
$obj_category = new Category();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "category_id, shortcode, title, featured, status";
$condition = "";
$category_details = $obj_category->getCategoryDetails($fields, $condition, '', '', 0);

if (isset($category_details) && !empty($category_details)) {
    $delimiter = ",";
    $filename = "category-" . date('Y-m-d') . ".csv";

    $f = fopen('php://memory', 'w');

    $header = array('Category ID', 'Short Code', 'Name', 'Featured', 'Status');
    fputcsv($f, $header, $delimiter);

    foreach ($category_details as $category_detail) {
        fputcsv($f, $category_detail, $delimiter);
    }

    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);
}
?>
