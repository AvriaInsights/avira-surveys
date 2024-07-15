<?php

require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$surveyid = $_POST['surveyid'];
$surveytitle=$_POST['surveytitle'];
$survey_purpose=$_POST['survey_purpose'];
$campaign_name=$_POST['campaign_name'];
$surveycatid=$_POST['category'];
$surveydescription=$_POST['description'];
$footer_tagline=$_POST['footer_tagline'];
$take_away=$_POST['take_away'];
$userformposition=$_POST['user_form_position'];
$userid=$_SESSION['ifg_admin']['client_id'];
/*$filledby=$_POST['filledby'];*/


$update_data['survey_title'] = mysqli_real_escape_string($conn, $surveytitle);
$update_data['campaign_name'] = mysqli_real_escape_string($conn, $campaign_name);
$update_data['survey_purpose'] = mysqli_real_escape_string($conn, $survey_purpose);
$update_data['category_id'] = mysqli_real_escape_string($conn, $surveycatid);
$update_data['user_id'] = mysqli_real_escape_string($conn, $userid);

$update_data['survey_description'] = mysqli_real_escape_string($conn, $surveydescription);
$update_data['footer_tagline'] = mysqli_real_escape_string($conn, $footer_tagline);
$update_data['take_away'] = mysqli_real_escape_string($conn, $take_away);
$update_data['submit_form_position'] = mysqli_real_escape_string($conn, $userformposition);
$update_data['updated_at'] = date("Y-m-d h:i:s");
$condition = "`tbl_survey`.`survey_id` = '" . $surveyid . "'";
$lasupdateid = $obj_survey->updateSurveyTitle($update_data,$condition,0);
//header("Location:" . SITEPATH . "dashboard");
//header("location:https://www.software-intent.com/survey/add-survey.php?surveyid=".$lastinsertid);
/*if($filledby=="Manual" || $filledby=="Template")
{
header("Location:" . SITEPATH . "add-survey?surveyid=".$surveyid);
}
if($filledby=="Bulk")
{
header("Location:" . SITEPATH . "bulk-survey.php?surveyid=".$surveyid);
}
if($filledby=="CopyPaste")
{
header("Location:" . SITEPATH . "copy-paste-survey.php?surveyid=".$surveyid);
}*/
?>