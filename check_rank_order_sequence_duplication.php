<?php 
require_once("survey/classes/cls-survey.php");
$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

$subqid=$_POST['subqueid'];
$rank_que_seq=$_POST['entseq'];
$que_id=$_POST['queid'];
 /**********All Sub Points Questions***************/
if($subqid != "")
{
    $fields_subpoints = "max(rank_order_sequence)";
    $condition_subpoints = "`tbl_questionSub`.`question_id` =".$que_id;
    $all_subpoints=$obj_survey->getSubQuestionPoints($fields_subpoints, $condition_subpoints, '', '', 0);
    
    
    foreach($all_subpoints as $all_subpoint)
    {
        $rank_seq = $all_subpoint['max(rank_order_sequence)'];
    }
    // echo $rank_seq;
     if($rank_que_seq > $rank_seq)
      {
         echo "Not Valid"; 
      }
      else
      {
          echo ""; 
           /* $fields_subpointsrank = "rank_order_sequence";
            $condition_subpointsrank = "`tbl_questionSub`.`question_id` =".$que_id." AND `tbl_questionSub`.`rank_order_sequence` = ".$rank_que_seq;
            $all_subpointsrank=$obj_survey->getSubQuestionPoints($fields_subpointsrank, $condition_subpointsrank, '', '', 0);
            if($all_subpointsrank)
            {
                echo "Rank Already Exits";
            }
            else
            {
                echo "Valid";
            }*/
          
        
      }
   /* foreach($all_subpoints as $all_subpoint)
    {
        $rank_order_seq = $all_subpoint['rank_order_sequence'];
    }
    if($rank_que_seq == $rank_order_seq)
    {
        echo "Rank Matched..!";
    }*/
}

?>