<?php
require_once("classes/cls-enquiry.php");

$obj_enquiry = new Enquiry();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "`tbl_enquiry`.`enquiry_id`, `tbl_report`.`title`, `tbl_enquiry`.`fname` AS `fullname`, `tbl_enquiry`.`email`, `tbl_enquiry`.`phone`";
$condition = "";
$sort_by = "`tbl_enquiry`.`created_at` DESC";
$enquiry_details = $obj_enquiry->getFullEnquiryDetails($fields, $condition, $sort_by, '', 0);
$enquiry_info = array();

foreach ($enquiry_details as $enquiry_detail) {
    $enquiry_data['title'] = htmlspecialchars($enquiry_detail['title']);
    $enquiry_data['fullname'] = htmlspecialchars($enquiry_detail['fullname']);
    $enquiry_data['email'] = htmlspecialchars($enquiry_detail['email']);
    $enquiry_data['phone'] = htmlspecialchars($enquiry_detail['phone']);
    $enquiry_data['action'] = '<a class="btn btn-success btn-circle" title="View Enquiry" href="view-enquiry.php?enquiry_id='. base64_encode($enquiry_detail['enquiry_id']).'"><i class="fa fa-list"></i></a>
                             <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-enquiry.php?enquiry_id='. base64_encode($enquiry_detail['enquiry_id']).'"><i class="fa fa-trash"></i></a>';
    
    $enquiry_info[] = $enquiry_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($enquiry_info),
    "iTotalDisplayRecords" => count($enquiry_info),
    "aaData" => $enquiry_info);

echo json_encode($results);


?>