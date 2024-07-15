<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

$conn = $obj_survey->getConnectionObj();
$surveyid = $_POST['surveyid'];
$question_content = $_POST['surveycontent'];

$insert_data['survey_id'] = mysqli_real_escape_string($conn, $surveyid);
$insert_data['question_content'] = mysqli_real_escape_string($conn, $question_content);
$insert_data['status'] = "Active";
$insert_data['created_at'] = date("Y-m-d h:i:s");
$insert_data['updated_at'] = date("Y-m-d h:i:s");
$lastinsertid = $obj_survey->insertSurveyCopyPaste($insert_data, 0);

header("Location: copy-paste-survey.php?surveyid=".$surveyid);
?>