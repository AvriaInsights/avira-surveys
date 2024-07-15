<?php
require_once("classes/cls-surveyclient.php");

$obj_survey_client = new Surveyclient();
$conn = $obj_survey_client->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$upduserid=$_POST['suserid'];
// Activate User
$update_data['status'] = "Inactive";
$update_data['updated_at'] = date("Y-m-d h:i:s");
$condition = "`tbl_client_user`.`client_id` = '" . $upduserid . "'";
$lastupdateid = $obj_survey_client->updateSurveyuser($update_data,$condition, 0);

//echo $lastupdateid;
?>
