<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
$conn = $obj_survey->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$updquestid=$_POST['updquestid'];
$radoptions=str_replace(array(':','*'),'',$_POST['radoptions']);
$opttype=$_POST['opttype'];
$subid=$_POST['subid'];

if($opttype=="optinsert")
{
        if($radoptions!="")
        {
            $insert_data['question_id'] = mysqli_real_escape_string($conn, $updquestid);
            $insert_data['question_subtitle'] = mysqli_real_escape_string($conn, addslashes($radoptions));
            $insert_data['status'] = "Active";
            $insert_data['created_at'] = date("Y-m-d h:i:s");
            $insert_data['updated_at'] = date("Y-m-d h:i:s");
            $lastinsertid = $obj_survey->insertSurveyQuestionSubPoints($insert_data, 0);
        }
}
else
{
    if($radoptions!="")
    {
        $update_data3['question_subtitle'] = mysqli_real_escape_string($conn, addslashes($radoptions));
        $condition3 = "`tbl_questionSub`.`question_subid` = '" . $subid . "'";
        $lastupdateid = $obj_survey->updateSurveyQuestionPoints($update_data3,$condition3, 0);
    }
    else
    {
        $condition4 = "`tbl_questionSub`.`question_subid` =".$subid;
        $obj_survey->deleteSubQuestionPoints($condition4, 0);
    }
}
echo $lastinsertid;
?>
