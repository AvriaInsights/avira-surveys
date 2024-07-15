<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$qid=$_POST['qid'];
$matrix_type=$_POST['inserttype'];

$fields_subquestions = "question_subid";
$condition_subquestions = "`tbl_questionSub`.`question_id` ='".$qid."' and `tbl_questionSub`.`matrix_type` ='".$matrix_type."'";
$orderby="`tbl_questionSub`.`question_subid` desc";
$all_subquestions=$obj_survey->getSubQuestionPoints($fields_subquestions, $condition_subquestions, $orderby, 1, 0);
if(isset($all_subquestions) && !empty($all_subquestions))
{
    foreach($all_subquestions as $all_subquestion)
    {
        $qsubid=$all_subquestion['question_subid'];
        //$cnt=$cnt1+1;
    }
}

$condition1 = "`tbl_questionSub`.`question_subid` =".$qsubid;
$obj_survey->deleteSubQuestionPoints($condition1, 0);
?>