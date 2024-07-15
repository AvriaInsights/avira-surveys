<?php
require_once("classes/cls-report.php");
$obj_report = new Report();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$fields = "tbl_report.report_id, tbl_report.title,tbl_category.title AS category";
$headers=$_POST['e_headerCheck_list'];  
foreach($headers as $chk1)  
   {  
    $fields .= ",tbl_report.".$chk1;  
   }  
$condition = "";
if($_POST['e_fromdate'] !="" && $_POST['e_todate'] !="")
{
    $condition.=" tbl_report.published_date>='" .$_POST['e_fromdate'] ."' AND  tbl_report.published_date<='" .$_POST['e_todate']."' AND ";
}
if(!empty($_POST['e_category']))
{ 
    $Category=$_POST['e_category'];
    $catids="";
    foreach($Category as $cat)  
    {  if($cat !="all")
      {
        $catids .= "'".$cat."',";
      }
    }  
    if($catids!="")
    {
        $catids = substr($catids, 0, -1);
        $condition.="tbl_category.shortcode in (". $catids.")";
    }

    // if($_POST['e_category'] !="all")
    // {
    // $condition .=" AND tbl_category.shortcode='". $_POST['e_category']."'";
    // }
}
if($_POST['e_price'] !="")
{ 
    if($_POST['e_price'] !="all")
    {
    $condition.=" AND tbl_report.price='". $_POST['e_price']."'";
    }
}
if($_POST['e_range'] !="")
{
    $record_range = trim($_REQUEST['e_range']);
    switch ($record_range) {
        case '0-500' :
            $filter_price_range = "BETWEEN 0 AND 500";
            $condition.= " AND tbl_report.report_id " . $filter_price_range . "";
            break;
        case '501-1000' :
            $filter_price_range = "BETWEEN 501 AND 1000";
            $condition.= " AND tbl_report.report_id " . $filter_price_range . "";
            break;
        case '1001-1500' :
            $filter_price_range = "BETWEEN 1001 AND 1500";
            $condition.= " AND tbl_report.report_id " . $filter_price_range . "";
            break;
        case '1501-2000' :
            $filter_price_range = "BETWEEN 1501 AND 2000";
            $condition.= " AND tbl_report.report_id " . $filter_price_range . "";
            break;
        case '2001-2500' :
            $filter_price_range = "BETWEEN 2001 AND 2500";
            $condition.= " AND tbl_report.report_id " . $filter_price_range . "";
            break;
        case '2501-3000' :
            $filter_price_range = "BETWEEN 2501 AND 3000";
            $condition.= " AND tbl_report.report_id " . $filter_price_range . "";
            break;
        default :
            $price_range = "all";
            break;
    }
} else {
    $price_range = "all";
}

   

$report_details = $obj_report->getFullReportDetails($fields, $condition, '`tbl_report`.`report_id` ASC', '', 0);

if (isset($report_details) && !empty($report_details)) {
    $delimiter = ",";
    $filename = "reports-" . date('M j Y h:i A') . ".csv";

    $f = fopen('php://memory', 'w');

    $headers = array("ID", "Title", "Category");
    $header=$_POST['e_headerCheck_list'];  
    foreach($header as $chk1)  
    {  
        if($chk1=="description")
        {
            array_push($headers,"Description");
        }
        else if($chk1=="toc")
        {
            array_push($headers,"Table of Content");
        }
        else if($chk1=="tnf")
        {
            array_push($headers,"Tables and Figures");
        }
        else if($chk1=="url_keywords")
        {
            array_push($headers,"URL Keywords");
        }
        else if($chk1=="price")
        {
            array_push($headers,"Single User Price");
        }
        else if($chk1=="eprice")
        {
            array_push($headers,"Enterprise User Price");
        }
        else
        {

        }
    } 

    array_push($headers, "URL");
    fputcsv($f, $headers, $delimiter);

    foreach ($report_details as $report_detail) {
        $title = $obj_report->removeSpace($report_detail['title']);
        $url = SITEPATH . 'report/' . $report_detail['report_id'] . '/' . $title;
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
