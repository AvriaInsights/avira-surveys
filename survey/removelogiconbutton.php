<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();


$currquestionid=$_POST['updquestid'];
$questtype=$_POST['questtype'];
$valarray="";
$skipvalarray="";



   if($questtype=="Rating" || $questtype=="Opinion Scale")
   {
        $fields_subquestions = "`tbl_questionSub`.`question_subtitle`,`tbl_questionSub`.`skip_question`";
        $condition_subquestions = "`tbl_questionSub`.`question_id` =".$currquestionid;
        $all_subquestions=$obj_survey->getSubQuestionPoints($fields_subquestions, $condition_subquestions, '', '', 0);
        foreach($all_subquestions as $all_subquestion)
        {
            $subtitle=$all_subquestion['question_subtitle'];
           
        }
            $valarray=explode(",",$subtitle);
            
            for($k=0;$k<count($valarray);$k++)
            {
                $newval1.="0".",";
            }
            $newval2=trim($newval1,",");
    
         $update_data['skip_question'] = mysqli_real_escape_string($conn, $newval2);
         $condition_subpoints = "`tbl_questionSub`.`question_id` ='".$currquestionid."'";
    }
    else
    {
        $update_data['skip_question'] = mysqli_real_escape_string($conn, "");
        $condition_subpoints = "`tbl_questionSub`.`question_id` ='".$currquestionid."'";
    }
    
    if($questtype=="Radio")
    {
        $update_data['skip_question'] = mysqli_real_escape_string($conn, "");
        $condition_subpoints = "`tbl_questionSub`.`question_id` ='".$currquestionid."'";
        
    }
    
    $update_subpoints=$obj_survey->updateSurveyQuestionPoints($update_data,$condition_subpoints, 0);
    
    if($questtype == "Text" || $questtype == "Checkbox" || $questtype == "Order" || $questtype == "Dropdown" || $questtype == "Mrating" || $questtype == "Matrix")
    {
        $update_data_que['skip_question_where_to'] = mysqli_real_escape_string($conn, "");
        $condition_que_points = "`tbl_questionBank`.`question_id` ='".$currquestionid."'";
        $insert_quepoints=$obj_survey->UpdateSurveyQuestionskip($update_data_que,$condition_que_points,0);
    } 


echo $update_subpoints;

?>