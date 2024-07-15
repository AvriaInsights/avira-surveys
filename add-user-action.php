<?php
require_once("survey/classes/cls-survey.php");
require_once("survey/classes/phpmailer.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();


$fname=$_POST['fname'];
$email=$_POST['email'];
$surveyid=$_POST['surveyid'];
$userid=$_POST['userid'];
$ipaddress=$_SERVER["REMOTE_ADDR"];
$flag=0;

$update_data['survey_fill_at'] = date("Y-m-d h:i:s");
$condition = "`tbl_survey`.`survey_id` = '" . $surveyid . "'";
$lastupdateidsurvey = $obj_survey->updateSurvey($update_data,$condition, 0);

$insert_data['survey_id'] = mysqli_real_escape_string($conn, $surveyid);
$insert_data['user_id'] = mysqli_real_escape_string($conn, $userid);
$insert_data['user_fullname'] = mysqli_real_escape_string($conn, $fname);
$insert_data['user_email'] = mysqli_real_escape_string($conn, $email);
$insert_data['ip_address'] = mysqli_real_escape_string($conn, $ipaddress);
if(isset($_POST['phone']))
{
    $phone=$_POST['phone'];
    $update_data['phone_no'] = mysqli_real_escape_string($conn, $phone);
}
$insert_data['status'] = "Active";
$insert_data['created_at'] = date("Y-m-d h:i:s");
$insert_data['updated_at'] = date("Y-m-d h:i:s");
$lastinsertid = $obj_survey->insertResponseUser($insert_data, 0);

$fields_survey= "*";
$all_surveys = $obj_survey->getSurveyDetail($fields_survey, $condition, '', '', 0);
foreach($all_surveys as $all_survey)
{
    $survey_url = strtolower($all_survey['survey_title']);
    $survey_url = str_replace(' ', '-', $survey_url); 
}

$_SESSION['response_user_id']=$lastinsertid;
$_SESSION['first_form_fname']=$fname;
$_SESSION['first_form_email']=$email;
header("location:".SITEPATHFRONT."survey-view/".$surveyid."/".$survey_url);

?>