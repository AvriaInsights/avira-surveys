<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();


if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}
$question_array=array();
$lineData2=array();
$i=1;
if(isset($_GET['surveyid']))
{
    $surveyid=$_GET['surveyid'];
    $fields_survey = "*";
    $condition_survey_detail = "`tbl_survey`.`survey_id` = '".$surveyid."'";
    $all_survey_details=$obj_survey->getSurveyDetail($fields_survey, $condition_survey_detail, '', '', 0);
    foreach($all_survey_details as $all_survey_detail)
    {
        $surveytitle='Survey Title:'.$all_survey_detail['survey_title'];
    }
    
    $fields_questions = "`tbl_questionBank`.`question_title`,`tbl_question_type`.`quest_type`,`tbl_questionBank`.`question_id`";
    $condition_survey_questions = "`tbl_questionBank`.`survey_id` = '".$surveyid."'";
    $specific_survey_questions=$obj_survey->getFullQuestionType($fields_questions, $condition_survey_questions, '', '', 0);
    foreach($specific_survey_questions as $specific_survey_question)
    {
        array_push($question_array,$specific_survey_question['question_title']."(".$specific_survey_question['quest_type'].")");
    }

    $fields_result = "*";
    $condition_response_user = "`tbl_response_user`.`survey_id` = '".$surveyid."' and survey_fill_position='Full'";
    $orderbyuser= "`tbl_response_user`.`response_user_id` desc";
    $survey_respose_users=$obj_survey->getSurveyUser($fields_result, $condition_response_user, $orderbyuser, '', 0);
    

    $delimiter = ",";
    $filename = "survey-result-" . time() . ".csv";

    $f = fopen('php://memory', 'w');

    $headertitle = array($surveytitle);
    fputcsv($f, $headertitle, $delimiter);
    
    $headerarray = array('Sr.No.', 'User Name', 'User Email');
    $headerfields = array_merge($headerarray,$question_array);
    fputcsv($f, $headerfields, $delimiter);

    foreach($survey_respose_users as $survey_respose_user)
    {
        
        $username=$survey_respose_user['user_fullname'];
        $useremail=$survey_respose_user['user_email'];
        $lineData1=array($i,$survey_respose_user['user_fullname'], $survey_respose_user['user_email']);
       // print_r($specific_survey_questions);
        
        $lineData2=[];
        foreach($specific_survey_questions as $specific_survey_question)
        {
                $fields_survey_result_ans = "*";
                $condition_survey_result_ans = "`tbl_response_result`.`response_user_id` = '".$survey_respose_user['response_user_id']."' and `tbl_response_result`.`question_id` = '".$specific_survey_question['question_id']."'";
                $all_result_surveys_anss1=$obj_survey->getSurveyResult($fields_survey_result_ans, $condition_survey_result_ans, '', '', 0);
                
                //print_r($all_result_surveys_anss);
                
                if(!empty($all_result_surveys_anss1))
                {   $answer1="";
                   
                          $answer="";
                         
                          foreach($all_result_surveys_anss1 as $all_result_surveys_anss12)
                          {
                              $qtitle=stripslashes($all_result_surveys_anss12['question_title']);
                              if(count($all_result_surveys_anss1)>1)
                              {
                                  if($all_result_surveys_anss12['answer_additional']!="")
                                  {
                                    $answer.=" ".stripslashes($all_result_surveys_anss12['answer'])." :: ".stripslashes($all_result_surveys_anss12['answer_additional']).";";
                                  }
                                  else
                                  {
                                     $answer.=" ".stripslashes($all_result_surveys_anss12['answer']).";"; 
                                  }
                              }
                              else
                              {
                                 if($all_result_surveys_anss12['answer_additional']!="")
                                 {
                                    $answer=stripslashes($all_result_surveys_anss12['answer'])." :: ".stripslashes($all_result_surveys_anss12['answer_additional']);
                                 }
                                 else
                                 {
                                     $answer=stripslashes($all_result_surveys_anss12['answer']);
                                 }
                              }
                          }
                          $answer1.=trim($answer,";")."*";
                          //$lineData2=array($answer1);    
                          
                    
                   
                    $ans33=trim($answer1,"*");
                    $ansres=explode("*",$ans33);
                    for($k=0;$k<count($ansres);$k++)
                    {
                        array_push($lineData2,$ansres[$k]);
                    }
                    
                }
                else
                {
                    array_push($lineData2,"-");
                   
                }
                
                
        }
        $lineData3=array_merge($lineData1,$lineData2);
        fputcsv($f, $lineData3, $delimiter);
        $i++;
          
    }
   

    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);

}
?>
