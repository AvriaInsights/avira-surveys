<?php

require_once("classes/cls-request.php");
$obj_report = new Request();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$fields = "report_id, fname, email, phone, job_title, company, comment, created_at";
 
$condition = "";

$from_date = $_POST['e_fromdate'];
$from_date = $from_date." 00:00:01";

$to_date = $_POST['e_todate'];
$to_date = $to_date." 00:00:01";

if($from_date !="" && $to_date !="")
{
    $condition .=" tbl_request.created_at>='" .$from_date ."' AND  tbl_request.created_at<='" .$to_date."'";
}

$report_details = $obj_report->getRequestDetails($fields, $condition, '`tbl_request`.`request_id` ASC', '', 0);

if (isset($report_details) && !empty($report_details)) {
    $delimiter = ",";
    $filename = "Request-Sample-" . date('M j Y h:i A') . ".csv";

    $f = fopen('php://memory', 'w');

    $headers = array("Report ID", "Name", "Email", "Phone", "Job Title", "Company", "Comments", "Date");
   // $header=$_POST['e_headerCheck_list'];  
   /* if($report_details)  
    { 
       
            array_push($headers,"Report ID");
       
            array_push($headers,"Title");
       
            array_push($headers,"Name");
        
            array_push($headers,"Email");
       
            array_push($headers,"Phone");
       
            array_push($headers,"Job Title");
            
            array_push($headers,"Company");
            
            array_push($headers,"Comments");
        
    } */

    array_push($headers, "URL");
    fputcsv($f, $headers, $delimiter);

    foreach ($report_details as $report_detail) {
        //$title = $obj_report->removeSpace($report_detail['title']);
        $url = SITEPATH . 'report/' . $report_detail['report_id'] . '/' . "sample";
        $report_detail['report_link'] = $url;
        $trimmed_array = array_map('trim', $report_detail);
        fputcsv($f, $trimmed_array, $delimiter);
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
   echo "<a class='$class' href=\"export-request.php\">Back</a>";
}
?>
