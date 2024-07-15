<?php
require_once("classes/cls-discount.php");

$obj_discount = new Discount();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "`tbl_discount`.`discount_id`, `tbl_report`.`title`, `tbl_discount`.`fname` AS `fullname`, `tbl_discount`.`email`, `tbl_discount`.`phone`";
$condition = "";
$sort_by = "`tbl_discount`.`created_at` DESC";
$discount_details = $obj_discount->getFullDiscountDetails($fields, $condition, $sort_by, '', 0);
$discount_info = array();

foreach ($discount_details as $discount_detail) {
    $discount_data['title'] = htmlspecialchars($discount_detail['title']);
    $discount_data['fullname'] = htmlspecialchars($discount_detail['fullname']);
    $discount_data['email'] = htmlspecialchars($discount_detail['email']);
    $discount_data['phone'] = htmlspecialchars($discount_detail['phone']);
    $discount_data['action'] = '<a class="btn btn-success btn-circle" title="View Discount" href="view-discount.php?discount_id='. base64_encode($discount_detail['discount_id']).'"><i class="fa fa-list"></i></a>
                             <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-discount.php?discount_id='. base64_encode($discount_detail['discount_id']).'"><i class="fa fa-trash"></i></a>';
    
    $discount_info[] = $discount_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($discount_info),
    "iTotalDisplayRecords" => count($discount_info),
    "aaData" => $discount_info);

echo json_encode($results);


?>