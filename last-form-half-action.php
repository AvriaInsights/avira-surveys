<?php
require_once("survey/classes/cls-survey.php");
require_once("survey/classes/phpmailer.php");
//session_start();
$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();


$surveyid=$_POST['surveyid'];
$userid=$_POST['userid'];
$ipaddress=$_SERVER["REMOTE_ADDR"];
$flag=0;

$update_data['survey_fill_at'] = date("Y-m-d h:i:s");
$condition = "`tbl_survey`.`survey_id` = '" . $surveyid . "'";
$lastupdateidsurvey = $obj_survey->updateSurvey($update_data,$condition, 0);

$insert_data['survey_id'] = mysqli_real_escape_string($conn, $surveyid);
$insert_data['user_id'] = mysqli_real_escape_string($conn, $userid);
$insert_data['ip_address'] = mysqli_real_escape_string($conn, $ipaddress);
//$insert_data['survey_fill_position'] = "Half";
$insert_data['status'] = "Active";
$insert_data['created_at'] = date("Y-m-d h:i:s");
$insert_data['updated_at'] = date("Y-m-d h:i:s");
$lastinsertid = $obj_survey->insertResponseUser($insert_data, 0);

//$_SESSION['last_form_user_response_id']=$lastinsertid; 
echo $lastinsertid;
?>