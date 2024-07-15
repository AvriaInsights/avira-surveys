<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$subtitle=$_POST['submattitle'];
$subid=$_POST['subid'];


$condition1 = "`tbl_questionSub`.`question_subid` = '" . $subid . "'";
$update_data1['question_subtitle'] = mysqli_real_escape_string($conn, addslashes($subtitle));
$update_data1['updated_at'] = date("Y-m-d h:i:s");
$updid = $obj_survey->updateSurveyQuestionPoints($update_data1,$condition1, 0);





//echo $condition1;
?>
