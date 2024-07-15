<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}
$responseid=$_GET['resid'];
$userid=$_SESSION['ifg_admin']['client_id'];

/**********Question and answer Survey***************/
$fields_survey_result_user = "user_fullname,user_email";
$condition_survey_result_user = "`tbl_response_user`.`response_user_id` = '".$responseid."'";
$all_result_surveys_users=$obj_survey->getSurveyUser($fields_survey_result_user, $condition_survey_result_user, '', '', 0);
foreach($all_result_surveys_users as $all_result_surveys_user)
{
   $filledby=$all_result_surveys_user['user_fullname']."(".$all_result_surveys_user['user_email'].")";
}
echo $filledby;
?>