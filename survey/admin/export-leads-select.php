<?php
require_once("classes/cls-request.php");

$obj_request = new Request();

if(!empty($_POST['priority']))
{
    //$priority_wise=$_GET['prio'];
    $condition= "`tbl_request`.`priority_wise`='".$_POST['priority']."' AND tbl_request.published_date BETWEEN'" .$_POST['e_fromdate'] ."' AND '" .$_POST['e_todate']."'";
}
else
{
    $condition= "tbl_request.published_date BETWEEN'" .$_POST['e_fromdate'] ."' AND '" .$_POST['e_todate']."'";
    
}

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "`tbl_request`.report_id, `tbl_request`.report_title, `tbl_request`.report_category, `tbl_request`.fname, `tbl_request`.email, `tbl_request`.phone, `tbl_request`.country, `tbl_request`.job_title, `tbl_request`.company, `tbl_request`.comment, `tbl_request`.website, `tbl_request`.request_from_page, `tbl_request`.priority_percent, `tbl_request`.priority_wise, `tbl_request`.created_at,`tbl_admin`.f_name,`tbl_admin`.lname";
//echo $condition;
$request_details = $obj_request->getFullRequestLeadsDetails($fields, $condition,'', '', 0);

if (isset($request_details) && !empty($request_details)) {
    $delimiter = ",";
    $filename = "leads-" . time() . ".csv";

    $f = fopen('php://memory', 'w');

    $header = array('Report ID', 'Report Title', 'Report Category', 'Fullname', 'Email', 'Phone', 'Country', 'Designation', 'Company', 'Specific Interest', 'Enquiry Website', 'Enquiry Page', 'Leads Score', 'Leads Type', 'Created Date', 'Lead Owner First Name', 'Lead Owner Last Name');
    fputcsv($f, $header, $delimiter);

    foreach ($request_details as $request_detail) {
        fputcsv($f, $request_detail, $delimiter);
    }

    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);
}
else {
   echo "Data not availble for current filters please try with different filters.";
   echo "</br>";
   echo "</br>";
   $class = 'btn btn-sm btn-primary';
   echo "<a class='$class' href=\"export-leads-date.php\">Back</a>";
}
?>
