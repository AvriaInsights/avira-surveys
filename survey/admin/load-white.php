<?php
require_once("classes/cls-white.php");

$obj_report = new White();

$conn = $obj_report->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
$fields = "paper_id, title, author_name, published_date, status";
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
    $report_data['paper_id'] = htmlspecialchars($report_detail['paper_id']);
    $report_data['title'] = htmlspecialchars($report_detail['title']);
    $report_data['author_name'] = htmlspecialchars($report_detail['author_name']);
    $report_data['published_date'] = htmlspecialchars($report_detail['published_date']);
    $report_data['status'] = htmlspecialchars($report_detail['status']);
    $report_data['action'] = '<a class="btn btn-success btn-circle" title="View Report" href="view-report.php?paper_id='. base64_encode($report_detail['paper_id']).'"><i class="fa fa-list"></i></a>
                              <a class="btn btn-default btn-circle" title="Edit Report" href="add-report.php?paper_id='. base64_encode($report_detail['paper_id']).'"><i class="fa fa-edit"></i></a>';
    if($_SESSION['ifg_admin']['role'] == "superadmin") {
        $report_data['action'] .= '&nbsp;<a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-report.php?paper_id='. base64_encode($report_detail['paper_id']).'"><i class="fa fa-trash"></i></a>';
    }

    $report_data = array_values($report_data);
    $report_info['data'][] = $report_data;
}

echo json_encode($report_info);


?>