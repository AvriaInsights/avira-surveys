<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$updsurveyid=$_POST['surveyid'];
$survaystatus = $_POST['chk_publish'];
//echo "$survaystatus"; exit;

/**********Question Bank All***************/
    $fields_quest_bank = "*";
    $condition_quest_bank = "`tbl_questionBank`.`status` = 'Active' and `tbl_questionBank`.`survey_id`='".$updsurveyid."'";
    $question_bank_lists=$obj_survey->getQuestionBank($fields_quest_bank, $condition_quest_bank, '', '', 0);
    if($question_bank_lists)
    {
        if($survaystatus == "Published")
        {
           $survaystatus_update = "Unpublished";
        }
        if($survaystatus == "Unpublished"){
            $survaystatus_update = "Published";
        }
        $update_data['survey_status'] = $survaystatus_update;
        $update_data['updated_at'] = date("Y-m-d h:i:s");
        $condition = "`tbl_survey`.`survey_id` = '" . $updsurveyid . "'";
        $lastupdateid = $obj_survey->updateSurvey($update_data,$condition, 0);
        echo $lastupdateid;
    }
    else
    {
        echo "Without Questions Survey Can't Published";
    }
//echo $lastupdateid;
?>
