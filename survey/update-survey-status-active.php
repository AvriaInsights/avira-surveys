<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$updsurveyid=$_POST['surveyid'];
$update_data['status'] = "Active";
$update_data['updated_at'] = date("Y-m-d h:i:s");
$condition = "`tbl_survey`.`survey_id` = '" . $updsurveyid . "'";
$lastupdateid = $obj_survey->updateSurvey($update_data,$condition, 0);

//echo $lastupdateid;
?>
