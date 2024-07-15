<?php 
require_once("classes/cls-survey.php");
$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$subqid=$_POST['subqid'];
$rank_que_seq=$_POST['drp_seq'];
$que_id=$_POST['queid'];

echo "sub id =" .$subqid; exit;
/*********Sub Questions Rank Sequence Update***************/

$condition = "`tbl_questionSub`.`question_subid` = '" . $subqid . "'";
$update_data['rank_order_sequence'] = mysqli_real_escape_string($conn, $rank_que_seq);
$update_data['updated_at'] = date("Y-m-d h:i:s");
$updid = $obj_survey->updateSubQuestionranksequnce($update_data,$condition, 0);


$fields_questions = "*";
$condition_questions = "`tbl_questionSub`.`question_subid`='" . $subqid ."'";
$rank_questions_seq=$obj_survey->getSubQuestionPoints($fields_questions, $condition_questions,'', '', 0);
if(isset($rank_questions_seq) && !empty($rank_questions_seq))
{
    foreach($rank_questions_seq as $rank_questions_seq)
    {
        $rank_sequence =$rank_questions_seq['rank_order_sequence'];
       
    }
}

if($updid)
{
    echo "data updated"; exit;
    $condition_rank = "`tbl_questionSub`.`question_id` = '" . $que_id . "' and `tbl_questionSub`.`rank_order_sequence` = '" . $rank_que_seq . "'";
    $update_data1['rank_order_sequence'] = mysqli_real_escape_string($conn, $rank_sequence);
    $update_data1['updated_at'] = date("Y-m-d h:i:s");
     $ranksuqupdate=$obj_survey->updateSubQuestionranksequnce($update_data1,$condition_rank, 0);
    
}



?>