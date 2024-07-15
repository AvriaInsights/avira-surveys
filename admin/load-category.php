<?php
require_once("classes/cls-category.php");

$obj_category = new Category();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "category_id, shortcode, title, featured, status";
$condition = "";
$category_details = $obj_category->getCategoryDetails($fields, $condition, '', '', 0);
$category_info = array();

foreach ($category_details as $category_detail) {
    $category_data['category_id'] = htmlspecialchars($category_detail['category_id']);
    $category_data['shortcode'] = htmlspecialchars($category_detail['shortcode']);
    $category_data['title'] = htmlspecialchars($category_detail['title']);
    $category_data['featured'] = htmlspecialchars($category_detail['featured']);
    $category_data['status'] = htmlspecialchars($category_detail['status']);
    $category_data['action'] = '<a class="btn btn-success btn-circle" title="View Category" href="view-category.php?category_id='. base64_encode($category_detail['category_id']).'"><i class="fa fa-list"></i></a>
                             <a class="btn btn-default btn-circle" title="Edit Category" href="add-category.php?category_id='. base64_encode($category_detail['category_id']).'"><i class="fa fa-edit"></i></a>
                             <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-category.php?category_id='. base64_encode($category_detail['category_id']).'"><i class="fa fa-trash"></i></a>';
    
    $category_info[] = $category_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($category_info),
    "iTotalDisplayRecords" => count($category_info),
    "aaData" => $category_info);

echo json_encode($results);


?>