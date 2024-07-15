<?php
require_once("classes/cls-faq.php");
$obj_faq = new Faq();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

//if (isset($_GET['report_id']) && $_GET['report_id'] != "") {
    $fields = "*";
    $condition = "`tbl_faq`.`report_id` = '" . base64_decode($_GET['report_id']) . "'";
    $faq_details = $obj_faq->getFAQDetails($fields, $condition, '', '', 0);
//} 
$faq_info = array();

foreach ($faq_details as $faq_detail) {
    $faq_data['faq_id'] = htmlspecialchars($faq_detail['faq_id']);
    $faq_data['question'] = htmlspecialchars($faq_detail['faq_title']);
    $faq_data['answer'] = htmlspecialchars($faq_detail['faq_content']);
    $faq_data['status'] = htmlspecialchars($faq_detail['status']);
    $faq_data['action'] = '<a class="btn btn-default btn-circle" title="Edit FAQ" href="add-faq.php?faq_id='. base64_encode($faq_detail['faq_id']).'"><i class="fa fa-edit"></i></a>
                             <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="Delete FAQ" data-href="delete-faq.php?faq_id='. base64_encode($faq_detail['faq_id']).'"><i class="fa fa-trash"></i></a>';
    
    $faq_info[] = $faq_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($faq_info),
    "iTotalDisplayRecords" => count($faq_info),
    "aaData" => $faq_info);

echo json_encode($results);


?>