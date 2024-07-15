<?php
require_once("survey/classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

$flastinid=$_POST['firstform'];
$clastinid=$_POST['campaignform'];
$update_data['feedback_id'] = mysqli_real_escape_string($conn, $_POST['fedradio']);
if($flastinid!="")
{
$condition = "`tbl_response_user`.`response_user_id` = '" . $flastinid . "'";
}
if($clastinid!="")
{
$condition = "`tbl_response_user`.`response_user_id` = '" . $clastinid . "'";
}
$lastupdateidsurvey = $obj_survey->UpdateResponseUser($update_data,$condition, 0);

unset($_SESSION['response_user_id']); 
unset($_SESSION['campaign_user_id']);
header("location:".SITEPATHFRONT."survey-list");
?>