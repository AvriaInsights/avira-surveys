<?php
require_once("survey/classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

$update_data1['q_count'] =  mysqli_real_escape_string($conn, $_POST['campqcnt']);
$update_data1['q_last_attempt_qno'] =  mysqli_real_escape_string($conn, $_POST['campqid']);
$condition1 = "`tbl_campaign_user`.`camp_response_user_id` = '" . $_POST['campaign_user_id'] . "'";
$lastupdatecampaignidsurvey = $obj_survey->updateCampaignSurvey($update_data1,$condition1, 0);


?>