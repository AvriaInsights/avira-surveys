<?php

require_once("classes/cls-category.php");

$obj_category = new Category();

$delete_ids = $_POST['bundlereportCheck'];

for($i=0;$i<count($delete_ids);$i++)
{
 
   $condition = " `tbl_bundle_report`.`bundle_rep_id`= '" . $delete_ids[$i] . "'";

    $all_owner = $obj_category->deleteBundleReport($condition, 0);
}    
    $_SESSION['success'] = "<strong>Congratulations</strong> Bundle Report information has been deleted successfully.";
    

header("Location:manage-bundle-report.php");
exit(0);
?>