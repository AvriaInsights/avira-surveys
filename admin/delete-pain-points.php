<?php
require_once("classes/cls-report.php");

$obj_report = new Report();

$delete_ids = $_POST['keyCheck'];

for($i=0;$i<count($delete_ids);$i++)
{
 
   $condition = " `tbl_pain_points`.`pain_id`= '" . $delete_ids[$i] . "'";

    $all_owner = $obj_report->deletePain($condition, 0);
}    
    $_SESSION['success'] = "<strong>Congratulations</strong> Pain Points has been deleted successfully.";
    

header("Location:manage-pain-points.php");
exit(0);
?>