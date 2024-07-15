<?php

require_once("classes/cls-category.php");

$obj_category = new Category();

$delete_ids = $_POST['topicCheck'];

for($i=0;$i<count($delete_ids);$i++)
{
 
   $condition = " `tbl_topics_report`.`bundle_id`= '" . $delete_ids[$i] . "'";

    $all_owner = $obj_category->deletetopic($condition, 0);
}    
    $_SESSION['success'] = "<strong>Congratulations</strong> topic Report information has been deleted successfully.";
    

header("Location:manage-topic.php");
exit(0);
?>