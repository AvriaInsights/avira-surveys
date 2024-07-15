<?php 
require_once("classes/cls-survey.php");
$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$qid=$_POST['qid'];
$surveyid=$_POST['survid'];

/**********Questions Details***************/
$fields_questions = "*";
$condition_questions = "`tbl_questionBank`.`question_id` =".$qid;
$all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, '', '', 0);
foreach($all_questions as $all_question)
{
    $que_type_id = $all_question['quest_type_id'];
    $que_title = $all_question['question_title'];
    $tooltip = $all_question['tooltip'];
    $is_required = $all_question['is_required'];
    $sequence=$all_question['sequence'];
    $status = $all_question['status'];
    $matrix_input_type = $all_question['matrix_input_type'];
}

    $fields_questions1 = "*";
    echo $condition_questions1 = "`tbl_questionBank`.`survey_id` ='".$surveyid."' and `tbl_questionBank`.`sequence` >'".$sequence."'";
    $orderby1="`tbl_questionBank`.`question_id` asc";
    $all_questions1=$obj_survey->getQuestionBank($fields_questions1, $condition_questions1, $orderby1, '', 0);
    $last_sequence = $sequence+1;
    if(isset($all_questions1))
    {
        $sequence=$last_sequence+1;
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

if($all_questions)
{       
       $insert_data['quest_type_id'] = mysqli_real_escape_string($conn, $que_type_id);
       $insert_data['survey_id'] = mysqli_real_escape_string($conn, $surveyid);
       $insert_data['question_title'] = mysqli_real_escape_string($conn, $que_title);
       $insert_data['status'] = mysqli_real_escape_string($conn,$status);
       $insert_data['tooltip']=mysqli_real_escape_string($conn,$tooltip);
       $insert_data['is_required']=mysqli_real_escape_string($conn,$is_required);
       $insert_data['matrix_input_type']=mysqli_real_escape_string($conn,$matrix_input_type);
       $insert_data['created_at'] = date("Y-m-d h:i:s");
       $insert_data['updated_at'] = date("Y-m-d h:i:s");
       $insert_data['sequence']=mysqli_real_escape_string($conn,$last_sequence);
       $lastinsertidquestion = $obj_survey->insertSurveyQuestion($insert_data, 0); 
       if($lastinsertidquestion)
       {
           /**********Subquestions Details***************/
        $fields_sub_questions = "*";
        $condition_sub_questions = "`tbl_questionSub`.`question_id` =".$qid;
        $all_sub_questions=$obj_survey->getSubQuestionPoints($fields_sub_questions, $condition_sub_questions, '', '', 0);
    foreach($all_sub_questions as $all_sub_question)
    {
        $que_subtitle = $all_sub_question['question_subtitle'];
        $skip_question = $all_sub_question['skip_question'];
        $opinion_scale_text = $all_sub_question['opinion_scale_text'];
        $rankordersequence = $all_sub_question['rank_order_sequence'];
        $matrix_type = $all_sub_question['matrix_type'];
        $status=$all_sub_question['status'];
        
               $insert_data2['question_id'] = mysqli_real_escape_string($conn, $lastinsertidquestion);
               $insert_data2['question_subtitle'] = mysqli_real_escape_string($conn, $que_subtitle);
               $insert_data2['skip_question'] = mysqli_real_escape_string($conn, $skip_question);
               $insert_data2['opinion_scale_text'] = mysqli_real_escape_string($conn,$opinion_scale_text);
               $insert_data2['status']=mysqli_real_escape_string($conn,$status);
               $insert_data2['rank_order_sequence'] = mysqli_real_escape_string($conn, $rankordersequence);
               $insert_data2['matrix_type'] = mysqli_real_escape_string($conn, $matrix_type);
               $insert_data2['created_at'] = date("Y-m-d h:i:s");
               $insert_data2['updated_at'] = date("Y-m-d h:i:s");
               $lastinsertsubidquestionid = $obj_survey->insertSurveyQuestionSubPoints($insert_data2, 0); 
    }
          
   }
}
?>