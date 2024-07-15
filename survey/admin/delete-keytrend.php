<?php

require_once("classes/cls-category.php");

$obj_category = new Category();

$delete_ids = $_POST['keyCheck'];

for($i=0;$i<count($delete_ids);$i++)
{
 
   $condition = " `tbl_keytrend`.`key_id`= '" . $delete_ids[$i] . "'";

    $all_owner = $obj_category->deletekeytrend($condition, 0);
}    
    $_SESSION['success'] = "<strong>Congratulations</strong> Keytrend Report information has been deleted successfully.";
    

header("Location:manage-keytrend-report.php");
exit(0);
?>