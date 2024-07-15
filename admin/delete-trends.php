<?php
require_once("classes/cls-report.php");

$obj_report = new Report();

$delete_ids = $_POST['keyCheck'];

for($i=0;$i<count($delete_ids);$i++)
{
 
   $condition = " `tbl_trends`.`trends_id`= '" . $delete_ids[$i] . "'";

    $all_owner = $obj_report->deleteTrends($condition, 0);
}    
    $_SESSION['success'] = "<strong>Congratulations</strong> Trends has been deleted successfully.";
    

header("Location:manage-trends.php");
exit(0);
?>