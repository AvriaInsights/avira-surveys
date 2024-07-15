<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

$qid=$_POST['qid'];
$arr1 = array();
$alloption1="";
/**********All Sub Points***************/
$fields_subpoints = "*";
$condition_subpoints = "`tbl_questionSub`.`question_id` =".$qid;
$all_subpoints=$obj_survey->getSubQuestionPoints($fields_subpoints,$condition_subpoints, '', '', 0);
foreach($all_subpoints as $all_subpoint)
{
     $alloption1.=$all_subpoint['question_subtitle'].":".$all_subpoint['question_subid'].":".$all_subpoint['question_id'].",";
    
}
$arr1['qsubtitle'] = trim($alloption1,",");
echo json_encode($arr1);
?>