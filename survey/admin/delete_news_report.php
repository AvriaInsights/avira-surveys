<?php

require_once("classes/cls-category.php");

$obj_category = new Category();

$delete_ids = $_POST['newsCheck'];

for($i=0;$i<count($delete_ids);$i++)
{
 
   $condition = " `tbl_news_report`.`news_rep_id`= '" . $delete_ids[$i] . "'";

    $all_owner = $obj_category->deleteNewsreport($condition, 0);
}    
    $_SESSION['success'] = "<strong>Congratulations</strong> News Report information has been deleted successfully.";
    

header("Location:manage-news-reports.php");
exit(0);
?>