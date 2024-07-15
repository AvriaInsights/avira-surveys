<?php
require_once("survey/classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();


$array = $_POST['order'];
$qstid = $_POST['qstid'];
//$spqstsubids="";
$spqstsubval="";
$count = 1;
//  foreach ($array as $idval) {
//     $update_data['rank_order_sequence'] = mysqli_real_escape_string($conn, $count);
//     $condition = "`tbl_questionSub`.`question_subid` = '" . $idval . "'";
//     $obj_survey->updateSurveyQuestionPoints($update_data,$condition, 0);
//     $count ++; 
//  }
// print_r($array);
foreach ($array as $idval) {
$fields_subpoints = "*";
$condition_subpoints = "`tbl_questionSub`.`question_subid` =".$idval;
$all_subpoints=$obj_survey->getSubQuestionPoints($fields_subpoints, $condition_subpoints, '', '', 0);

    foreach($all_subpoints as $all_subpoint)
    { 
        //$spqstsubids.=$all_subpoint['question_subid'].",";
        $spqstsubval.=$all_subpoint['question_subid']."◘".$count."♦";
    }
    $count ++; 
}
$trimspqstsubval=trim($spqstsubval,"♦");
//$trimspqstsubids=trim($spqstsubids,",");
echo $trimspqstsubval;
?>