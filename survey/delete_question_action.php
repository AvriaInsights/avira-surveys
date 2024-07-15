<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();
if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$qid=$_POST['qid'];
$surveyid=$_POST['survid'];

$fields_questions = "*";
$condition_questions = "`tbl_questionBank`.`question_id` =".$qid;
$all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, '', '', 0);
foreach($all_questions as $all_question)
{
    $sequence=$all_question['sequence'];
}

$fields_questions1 = "*";
$condition_questions1 = "`tbl_questionBank`.`survey_id` ='".$surveyid."' and `tbl_questionBank`.`sequence` >'".$sequence."'";
$orderby1="`tbl_questionBank`.`question_id` asc";
$all_questions1=$obj_survey->getQuestionBank($fields_questions1, $condition_questions1, $orderby1, '', 0);

if(isset($all_questions1))
{
    foreach($all_questions1 as $all_question1)
    {
        $updquestid = $all_question1['question_id'];
        $condition3 = "`tbl_questionBank`.`question_id` = '" . $updquestid . "'";
        $update_data3['sequence'] = mysqli_real_escape_string($conn, $sequence);
        $update_data3['updated_at'] = date("Y-m-d h:i:s");
        $updid = $obj_survey->updateSurveyQuestion($update_data3,$condition3, 0);
        $sequence=$sequence+1;
    }
    
}

$condition = "`tbl_questionBank`.`question_id` =".$qid;
$obj_survey->deleteQuestion($condition, 0);


$condition1 = "`tbl_questionSub`.`question_id` =".$qid;
$obj_survey->deleteSubQuestionPoints($condition1, 0);

$fields_questions3 = "*";
$condition_questions3 = "`tbl_questionBank`.`survey_id` ='".$surveyid."'";
$orderby3="`tbl_questionBank`.`question_id` asc";
$all_questions3=$obj_survey->getQuestionBank($fields_questions3, $condition_questions3, $orderby3, '', 0);
$cnt_que = count($all_questions3);
echo $cnt_que;
if($cnt_que == "0"){
        $update_data['survey_status'] = "Unpublished";
        $update_data['updated_at'] = date("Y-m-d h:i:s");
        $condition = "`tbl_survey`.`survey_id` = '" . $surveyid . "'";
        $lastupdateid11 = $obj_survey->updateSurvey($update_data,$condition, 0);
}
?>