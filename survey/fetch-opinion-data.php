<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

$editqid=680;
$qtype=$_POST['qtype'];
$scalevalue = "";
$alloption="";
/**********Edit Questions Data***************/
$fields_quest_bank = "`tbl_questionSub`.*";
$condition_quest_bank = "`tbl_questionSub`.`question_id`='".$editqid."'";
$question_bank_lists=$obj_survey->getSubQuestionPoints($fields_quest_bank, $condition_quest_bank, '', '', 0);
print_r($question_bank_lists);
foreach($question_bank_lists as $question_bank_list)
{
    echo $scalevalue = $question_bank_list['opinion_scale_text'];
    
}

echo $scalevalue;
?>