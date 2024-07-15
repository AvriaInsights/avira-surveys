<?php
require_once("classes/cls-surveyclient.php");

$obj_survey_client = new Surveyclient();
$conn = $obj_survey_client->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$updactuserid = $_POST['suseridactive'];
$update_data_active['status'] = "Active";
$update_data_active['updated_at'] = date("Y-m-d h:i:s");
$condition_active = "`tbl_client_user`.`client_id` = '" . $updactuserid . "'";
$lastupdateidactive = $obj_survey_client->updateSurveyuseractive($update_data_active,$condition_active, 0);

//echo $lastupdateid;
?>
