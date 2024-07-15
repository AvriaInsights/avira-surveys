<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();
if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$delsubpointid=$_POST['delsubpointid'];
$deletequeid=$_POST['qid'];
$qtype=$_POST['qtype'];

if($qtype == "Order")
{
    $fields_questions = "`tbl_questionSub`.`rank_order_sequence`";
    $condition_questions = "`tbl_questionSub`.`question_subid` =".$delsubpointid;
    $all_questions=$obj_survey->getSubQuestionPoints($fields_questions, $condition_questions, '', '', 0);
    foreach($all_questions as $all_question)
    {
        $sequence=$all_question['rank_order_sequence'];
    }
    if($sequence != ""){
        $fields_questions1 = "*";
        echo $condition_questions1 = "`tbl_questionSub`.`question_id` ='".$deletequeid."' and `tbl_questionSub`.`rank_order_sequence` >'".$sequence."'";
        $orderby1="`tbl_questionSub`.`rank_order_sequence` asc";
        $all_questions1=$obj_survey->getSubQuestionPoints($fields_questions1, $condition_questions1, $orderby1, '', 0);
    }
    if(isset($all_questions1))
    {
        foreach($all_questions1 as $all_question1)
        {
            $updquestid = $all_question1['question_subid'];
            $condition3 = "`tbl_questionSub`.`question_subid` = '" . $updquestid . "'";
            $update_data3['rank_order_sequence'] = mysqli_real_escape_string($conn, $sequence);
            $update_data3['updated_at'] = date("Y-m-d h:i:s");
            $updid = $obj_survey->updateSubQuestionranksequnce($update_data3,$condition3, 0);
            $sequence=$sequence+1;
        }
        
        $fields_sub__points = "*";
        $condition_sub_points = "`tbl_questionSub`.`question_subid` =".$delsubpointid;
        $all_sub_points=$obj_survey->getSubQuestionPoints($fields_sub__points, $condition_sub_points, '', '', 0);
        foreach($all_sub_points as $all_sub_point)
        {
            $subtitle = $all_sub_point['question_subtitle'];
        }
        $condition1 = "`tbl_questionSub`.`question_subid` =".$delsubpointid;
        $obj_survey->deleteSubQuestionPoints($condition1, 0);
        
        echo $subtitle;

    }
}
else
{

$fields_sub__points = "*";
$condition_sub_points = "`tbl_questionSub`.`question_subid` =".$delsubpointid;
$all_sub_points=$obj_survey->getSubQuestionPoints($fields_sub__points, $condition_sub_points, '', '', 0);
foreach($all_sub_points as $all_sub_point)
{
    $subtitle = $all_sub_point['question_subtitle'];
}
$condition1 = "`tbl_questionSub`.`question_subid` =".$delsubpointid;
$obj_survey->deleteSubQuestionPoints($condition1, 0);

echo $subtitle;
}
?>