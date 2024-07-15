<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$qid=$_POST['qid'];
$matrix_type=$_POST['inserttype'];

$fields_subquestions = "count(*)";
$condition_subquestions = "`tbl_questionSub`.`question_id` ='".$qid."' and `tbl_questionSub`.`matrix_type` ='".$matrix_type."'";
$all_subquestions=$obj_survey->getSubQuestionPoints($fields_subquestions, $condition_subquestions, '', 0, 0);
if(isset($all_subquestions) && !empty($all_subquestions))
{
    foreach($all_subquestions as $all_subquestion)
    {
        $cnt1=$all_subquestion['count(*)'];
        $cnt=$cnt1+1;
    }
}

if($matrix_type=="row")
{
    $subtitle="statement ".$cnt;
}
if($matrix_type=="column")
{
    $subtitle="Scale Point ".$cnt;
}
        $insert_data5['question_id'] = mysqli_real_escape_string($conn, $qid);
        $insert_data5['question_subtitle'] = mysqli_real_escape_string($conn, $subtitle);
        $insert_data5['matrix_type'] = mysqli_real_escape_string($conn, $matrix_type);
        $insert_data5['status'] = "Active";
        $insert_data5['created_at'] = date("Y-m-d h:i:s");
        $insert_data5['updated_at'] = date("Y-m-d h:i:s");
        $tt=$obj_survey->insertSurveyQuestionSubPoints($insert_data5, 0);
        
        echo $tt;
?>