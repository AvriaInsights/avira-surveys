<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$array = $_POST['arrayorder'];
$qstid = $_POST['qstid'];
//$spqstsubids="";
$spqstsubval="";
$count = 1;
 foreach ($array as $idval) {
    $update_data['sequence'] = mysqli_real_escape_string($conn, $count);
    $condition = "`tbl_questionBank`.`question_id` = '" . $idval . "'";
    $obj_survey->updateSurveyQuestion($update_data,$condition, 0);
    $count ++; 
 }


$fields_subpoints = "*";
$condition_subpoints = "`tbl_questionSub`.`question_id` =".$qstid;
$orderbysub="`tbl_questionSub`.`question_subid` asc ";
$all_subpoints=$obj_survey->getSubQuestionPoints($fields_subpoints, $condition_subpoints, $orderbysub, '', 0);

foreach($all_subpoints as $all_subpoint)
{ 
    //$spqstsubids.=$all_subpoint['question_subid'].",";
    $spqstsubval.=$all_subpoint['question_subtitle']."::".$all_subpoint['rank_order_sequence']."*";
}
$trimspqstsubval=trim($spqstsubval,"*");
//$trimspqstsubids=trim($spqstsubids,",");
echo $trimspqstsubval;
?>