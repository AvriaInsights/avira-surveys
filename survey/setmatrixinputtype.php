<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$mattype=$_POST['mattype'];
$qid=$_POST['qid'];


$condition1 = "`tbl_questionBank`.`question_id` = '" . $qid . "'";
$update_data1['matrix_input_type'] = mysqli_real_escape_string($conn, $mattype);
$update_data1['updated_at'] = date("Y-m-d h:i:s");
$updid = $obj_survey->updateSurveyQuestion($update_data1,$condition1, 0);





//echo $updid;
?>
