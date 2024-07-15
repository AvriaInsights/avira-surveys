<?php
require_once("classes/cls-report.php");

$obj_report = new Report();

$conn = $obj_report->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
$fields = "report_id, sku, title, price, eprice, status";
$condition = "title <> ''";
/*
if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != "") {
    $condition .= " AND category_id = '" . $_REQUEST['category_id'] . "'";
}
*/

$report_details = $obj_report->getReportDetails($fields, $condition, '', '', 0);
$report_info['data'] = array();

foreach ($report_details as $report_detail) {
    $report_data = array();
    $report_data['report_id'] = htmlspecialchars($report_detail['report_id']);
    $report_data['sku'] = htmlspecialchars($report_detail['sku']);
    $report_data['title'] = htmlspecialchars($report_detail['title']);
    $report_data['price'] = "$" . htmlspecialchars($report_detail['price']);
    $report_data['eprice'] = "$" . htmlspecialchars($report_detail['eprice']);
    $report_data['status'] = htmlspecialchars($report_detail['status']);
    $report_data['action'] = '<a class="btn btn-success btn-circle" title="View Report" href="view-report.php?report_id='. base64_encode($report_detail['report_id']).'"><i class="fa fa-list"></i></a>
                              <a class="btn btn-default btn-circle" title="Edit Report" href="add-report.php?report_id='. base64_encode($report_detail['report_id']).'"><i class="fa fa-edit"></i></a>';
    if($_SESSION['ifg_admin']['role'] == "superadmin") {
        $report_data['action'] .= '&nbsp;<a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-report.php?report_id='. base64_encode($report_detail['report_id']).'"><i class="fa fa-trash"></i></a>
        <a class="btn btn-default btn-circle" title="Add FAQ Report" href="add-report-faq.php?report_id='. base64_encode($report_detail['report_id']).'"><i class="fa fa-edit"></i></a>
        <a class="btn btn-success btn-circle" title="View FAQ" href="manage-faq.php?report_id='. base64_encode($report_detail['report_id']).'"><i class="fa fa-list"></i></a>';
    }

    $report_data = array_values($report_data);
    $report_info['data'][] = $report_data;
}

echo json_encode($report_info);


?>