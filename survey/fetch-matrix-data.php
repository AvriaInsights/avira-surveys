<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

$editqid=$_POST['editqid'];
$qtype=$_POST['qtype'];
$arr = array();
$alloption1="";
$alloption="";
/**********Edit Questions Data***************/
$fields_quest_bank = "`tbl_questionBank`.*,`tbl_questionSub`.*";
$condition_quest_bank = "`tbl_questionBank`.`status` = 'Active' and `tbl_questionBank`.`question_id`='".$editqid."'";
$question_bank_lists=$obj_survey->getFullQuestionDetails($fields_quest_bank, $condition_quest_bank, '', '', 0);
foreach($question_bank_lists as $question_bank_list)
{
    $arr['qtitle'] = stripslashes($question_bank_list['question_title']);
    $arr['qtooltip'] = stripslashes($question_bank_list['tooltip']);
    $arr['qrequired'] = $question_bank_list['is_required'];
    if($qtype=="Text" || $qtype=="Rating")
    {
        $arr['qsubtitle'] = stripslashes($question_bank_list['question_subtitle']);
    }
    elseif($qtype=="Opinion Scale")
    {
        $scalevalue = $question_bank_list['opinion_scale_text'];
    }
    elseif($qtype=="Matrix")
    {
        $alloption1.=stripslashes($question_bank_list['question_subtitle']).":".$question_bank_list['question_subid'].":".$question_bank_list['question_id'].":".$question_bank_list['matrix_type']."*";
    }
    else
    {
        $alloption.=stripslashes($question_bank_list['question_subtitle']).":".$question_bank_list['question_subid'].":".$question_bank_list['question_id']."*";
    }
}
//print_r($alloption); exit;
if($qtype=="Boolean" || $qtype=="Dropdown" || $qtype=="Checkbox" || $qtype=="Radio" || $qtype=="Order" || $qtype=="Mrating" || $qtype=="Matrix")
{
 
    $arr['qsubtitle'] = trim($alloption,"*");
   
}
if($qtype=="Opinion Scale")
{
    $arr['qsubtitle'] = $scalevalue;
    
}
if($qtype=="Matrix")
{
    $arr['qsubtitle'] = trim($alloption1,"*");
}

 echo json_encode($arr);
?>